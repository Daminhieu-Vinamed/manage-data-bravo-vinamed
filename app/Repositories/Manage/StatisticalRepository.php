<?php

namespace App\Repositories\Manage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticalRepository
{   
    public function paymentOrder()
    {
        $user = Auth::user();
        $deptCode = json_decode($user->department->DeptCode);
        
        $countA06 = DB::connection('A06')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA18 = DB::connection('A18')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA19 = DB::connection('A19')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA21 = DB::connection('A21')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA22 = DB::connection('A22')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA25 = DB::connection('A25')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();

        $staffA06 = DB::connection('A06')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA18 = DB::connection('A18')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA19 = DB::connection('A19')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA21 = DB::connection('A21')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA22 = DB::connection('A22')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA25 = DB::connection('A25')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        
        $staff = array(
            'A06' => $staffA06, 
            'A11' => $staffA11, 
            'A12' => $staffA12, 
            'A14' => $staffA14,
            'A18' => $staffA18, 
            'A19' => $staffA19, 
            'A21' => $staffA21,
            'A22' => $staffA22,
            'A25' => $staffA25,
        );

        return array(
            'countA06' => $countA06, 
            'countA11' => $countA11, 
            'countA12' => $countA12, 
            'countA14' => $countA14,
            'countA18' => $countA18, 
            'countA19' => $countA19, 
            'countA21' => $countA21, 
            'countA22' => $countA22,
            'countA25' => $countA25,
            
            'staff' => $staff
        );
    }

    public function onLeave() {

        $user = Auth::user();
        $deptCode = json_decode($user->department->DeptCode);
        
        $additionalWorkA06 = DB::connection('A06')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);
        
        $additionalWorkA11 = DB::connection('A11')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);
        
        $additionalWorkA12 = DB::connection('A12')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);
        
        $additionalWorkA14 = DB::connection('A14')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);

        $additionalWorkA18 = DB::connection('A18')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);
        
        $additionalWorkA19 = DB::connection('A19')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);

        $additionalWorkA21 = DB::connection('A21')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);
        
        $additionalWorkA22 = DB::connection('A22')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);
        
        $additionalWorkA25 = DB::connection('A25')->table('vB30HrmPTimesheet')
        ->where('IsActive', config('constants.number.one'))
        ->where('DocCode', 'NP')
        ->whereIn('DocStatus', ['35','36','37'])
        ->whereIn('DeptCode', $deptCode)
        ->get(['FromDate as start', 'ToDate as end', 'EmployeeName as title']);
        
        $additionalWorkAll = array_merge(
            $additionalWorkA06->toArray(), 
            $additionalWorkA11->toArray(), 
            $additionalWorkA12->toArray(),
            $additionalWorkA14->toArray(),
            $additionalWorkA18->toArray(),
            $additionalWorkA19->toArray(),
            $additionalWorkA21->toArray(),
            $additionalWorkA22->toArray(),
            $additionalWorkA25->toArray()
        );
        
        return $additionalWorkAll;
    }
}