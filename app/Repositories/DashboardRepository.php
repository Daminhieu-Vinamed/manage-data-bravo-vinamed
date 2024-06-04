<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function statisticalAdmin()
    {
        $countA06 = DB::connection('A06')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA18 = DB::connection('A18')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA19 = DB::connection('A19')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA21 = DB::connection('A21')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA22 = DB::connection('A22')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA25 = DB::connection('A25')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        
        $partA06 = DB::connection('A06')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA18 = DB::connection('A18')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA19 = DB::connection('A19')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA21 = DB::connection('A21')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA22 = DB::connection('A22')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        $partA25 = DB::connection('A25')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('DeptName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('DeptName')->get();
        
        $staffA06 = DB::connection('A06')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA18 = DB::connection('A18')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA19 = DB::connection('A19')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA21 = DB::connection('A21')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA22 = DB::connection('A22')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        $staffA25 = DB::connection('A25')->table('vB33AccDoc_ExploreJournalEntry_Web')->select('EmployeeName', DB::raw('count(*) as QuantityPaymentOrder'))->groupBy('EmployeeName')->get();
        
        $part = array(
            'A06' => $partA06, 
            'A11' => $partA11, 
            'A12' => $partA12, 
            'A14' => $partA14,
            'A18' => $partA18, 
            'A19' => $partA19, 
            'A21' => $partA21,
            'A22' => $partA22,
            'A25' => $partA25
        );
        
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
            
            'staff' => $staff,
            'part' => $part
        );
    }
    
    public function statisticalManager($deptCode)
    {
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
}