<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'about-halisi')
            ->where('is_published', true)
            ->first();

        return view('pages.about', compact('page'));
    }
}
