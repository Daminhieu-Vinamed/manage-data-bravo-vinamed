<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function statisticalAdmin()
    {
        $countA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $partA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $staffA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        return array(
            'countA11' => $countA11, 
            'countA12' => $countA12, 
            'countA14' => $countA14, 
            'partA11' => $partA11, 
            'partA12' => $partA12, 
            'partA14' => $partA14,
            'staffA11' => $staffA11, 
            'staffA12' => $staffA12, 
            'staffA14' => $staffA14
        );
    }
    
    public function statisticalManager($deptCode)
    {
        $countA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $countA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->whereIn('Dept', $deptCode)->count();
        $staffA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        $staffA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->whereIn('Dept', $deptCode)->groupBy('EmployeeName')->get();
        return array(
            'countA11' => $countA11, 
            'countA12' => $countA12, 
            'countA14' => $countA14,
            'staffA11' => $staffA11, 
            'staffA12' => $staffA12, 
            'staffA14' => $staffA14
        );
    }
}