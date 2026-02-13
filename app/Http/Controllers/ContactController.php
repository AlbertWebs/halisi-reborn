<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\Country;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $journey = null;
        $country = null;
        
        if ($request->has('journey')) {
            $journey = Journey::where('slug', $request->journey)->where('is_published', true)->first();
        }
        
        if ($request->has('country')) {
            $country = Country::where('slug', $request->country)->where('is_published', true)->first();
        }
        
        return view('pages.contact', compact('journey', 'country'));
    }
}
