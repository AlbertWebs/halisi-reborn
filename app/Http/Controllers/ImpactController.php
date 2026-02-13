<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImpactController extends Controller
{
    public function responsibleTravel()
    {
        return view('pages.responsible-travel');
    }

    public function climateCommunity()
    {
        return view('pages.climate-community');
    }
}
