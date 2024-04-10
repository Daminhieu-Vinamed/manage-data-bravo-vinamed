<?php

namespace App\Http\Controllers;

use App\Http\Requests\paymentOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function list()
    {
        return view('companies');
    }

    public function getData()
    {
        $connectA11 = DB::connection('A11');
        $connectA12 = DB::connection('A12');
        $connectA14 = DB::connection('A14');
        $a11 = $connectA11->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
        $a12 = $connectA12->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
        $a14 = $connectA14->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
        $arrayData = array_merge($a11->toArray(), $a12->toArray(), $a14->toArray());
        $collectData = collect($arrayData);
        return DataTables::of($collectData)
            ->editColumn('TotalAmount', function ($approvalVote) {
                return number_format($approvalVote->TotalAmount, config('constants.number.zero'), ".", ".");    
            })
            ->editColumn('DocDate', function ($approvalVote) {
                return date('d-m-Y', strtotime($approvalVote->DocDate));
            })
            ->addColumn('action', function ($approvalVote) {
                return '<button type="button" class="btn btn-success btn-sm approve-payment-request" branch_code="' . $approvalVote->BranchCode . '" stt="' . $approvalVote->Stt . '">Duyệt</button> ' .
                    ' <button type="button" class="btn btn-danger btn-sm cancel-payment-request" branch_code="' . $approvalVote->BranchCode . '" stt="' . $approvalVote->Stt . '">Từ chối</button>';
            })->make(true);
    }

    public function approvePaymentRequest(Request $request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $connectCompany->update(
                'EXEC Usp_ApproveDNTT ?, ?, ?, ?',
                [
                    $request->Stt,
                    Auth::user()->nUserId,
                    $request->description === config('constants.value.null') ? config('constants.value.null') : $request->description,
                    Auth::user()->username,
                ]
            );
            $connectCompany->commit();
            return response()->json(['error_correct' => 'Duyệt phiếu thành công !']);
        } catch (\Exception $e) {
            return response()->json(['error_incorrect' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ']);
        }
    }

    public function cancelPaymentRequest(paymentOrderRequest $request)
    {
        $connectCompany = DB::connection($request->BranchCode);
        $connectCompany->beginTransaction();
        try {
            $connectCompany->update(
                'EXEC Usp_CancelDNTT ?, ?, ?, ?',
                [
                    $request->Stt,
                    Auth::user()->nUserId,
                    $request->description,
                    Auth::user()->username,
                ]
            );
            $connectCompany->commit();
            return response()->json(['error_correct' => 'Từ chối duyệt phiếu thành công !']);
        } catch (\Exception $e) {
            return response()->json(['error_incorrect' => 'Hệ thống đã bị lỗi, vui lòng liên hệ phòng IT Vmed để được hỗ trợ']);
        }
    }
}