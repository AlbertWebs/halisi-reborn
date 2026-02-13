<?php

namespace App\Http\Controllers;

use App\Models\TrustPost;
use Illuminate\Http\Request;

class TrustController extends Controller
{
    public function index()
    {
        $posts = TrustPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();
        return view('trust.index', compact('posts'));
    }

    public function show(TrustPost $post)
    {
        return view('trust.show', compact('post'));
    }
}
