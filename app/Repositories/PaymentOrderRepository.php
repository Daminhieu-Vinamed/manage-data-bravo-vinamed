<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PaymentOrderRepository
{
    public function getData()
    {
        $A11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
        $A12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
        $A14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->orderBy('DocDate', 'desc')->get();
        return array('A11' => $A11, 'A12' => $A12, 'A14' => $A14);
    }

    public function approvePaymentOrder($connectCompany, $Stt, $nUserId, $description, $username)
    {
        return $connectCompany->update(
            'EXEC Usp_ApproveDNTT ?, ?, ?, ?',
            [
                $Stt,
                $nUserId,
                $description === config('constants.value.null') ? config('constants.value.null') : $description,
                $username,
            ]
        );
    }

    public function cancelPaymentOrder($connectCompany, $Stt, $nUserId, $description, $username)
    {
        return $connectCompany->update(
            'EXEC Usp_CancelDNTT ?, ?, ?, ?',
            [
                $Stt,
                $nUserId,
                $description === config('constants.value.null') ? config('constants.value.null') : $description,
                $username,
            ]
        );
    }
}
