<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\Country;
use App\Models\TrustPost;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $journeys = Journey::where('is_published', true)->get();
        $countries = Country::where('is_published', true)->get();
        $posts = TrustPost::where('is_published', true)->get();

        return response()->view('sitemap', [
            'journeys' => $journeys,
            'countries' => $countries,
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
