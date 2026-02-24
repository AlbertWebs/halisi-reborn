<?php

namespace App\Http\Controllers;

use App\Models\Page;

class MediaCreditsController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'media-credits')
            ->where('is_published', true)
            ->first();

        return view('pages.media-credits', compact('page'));
    }
}
