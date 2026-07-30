<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Judge;
use App\Models\Contestant;
use App\Models\Exposure;

class DashboardController extends Controller
{

    public function index()
    {

        // Count all data
        $contests = Contest::count();

        $judges = Judge::count();

        $contestants = Contestant::count();

        $exposures = Exposure::count();



        return view('dashboard', compact(
            'contests',
            'judges',
            'contestants',
            'exposures'
        ));

    }

}