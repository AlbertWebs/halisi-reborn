<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journey;
use App\Models\Country;
use App\Models\TrustPost;
use App\Models\Page;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'journeys' => Journey::where('is_published', true)->count(),
            'countries' => Country::where('is_published', true)->count(),
            'articles' => TrustPost::whereNotNull('published_at')->count(),
            'pages' => Page::where('is_published', true)->count(),
        ];

        $recentJourneys = Journey::latest()->take(5)->get();
        $recentCountries = Country::latest()->take(5)->get();
        $recentPosts = TrustPost::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentJourneys', 'recentCountries', 'recentPosts'));
    }
}
