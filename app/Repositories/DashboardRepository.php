<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function statisticalHead()
    {
        $countA11 = DB::connection('A11')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA12 = DB::connection('A12')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        $countA14 = DB::connection('A14')->table('vB33AccDoc_ExploreJournalEntry_Web')->count();
        return array('countA11' => $countA11, 'countA12' => $countA12, 'countA14' => $countA14);
    }
}