<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class ImpactController extends Controller
{
    public function responsibleTravel()
    {
        $page = Page::where('slug', 'responsible-regenerative-travel')
            ->where('is_published', true)
            ->first();

        return view('pages.responsible-travel', compact('page'));
    }

    public function climateCommunity()
    {
        return view('pages.climate-community');
    }
}
