<?php

namespace App\Http\Controllers;

use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'about-halisi')
            ->where('is_published', true)
            ->with('galleryImages')
            ->first();

        return view('pages.about', compact('page'));
    }
}
