<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TrustPost;
use Illuminate\Http\Request;

class TrustController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'halisi-trust')
            ->where('is_published', true)
            ->first();

        $featuredPost = TrustPost::query()
            ->orderByRaw('CASE WHEN published_at IS NULL THEN 1 ELSE 0 END')
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->first();
            
        $posts = TrustPost::query()
            ->when($featuredPost, function($query) use ($featuredPost) {
                $query->where('id', '!=', $featuredPost->id);
            })
            ->orderByRaw('CASE WHEN published_at IS NULL THEN 1 ELSE 0 END')
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('trust.index', compact('posts', 'featuredPost', 'page'));
    }

    public function show(TrustPost $post)
    {
        $relatedPosts = TrustPost::query()
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                $query->where('category', $post->category)
                    ->orWhere('category', 'like', '%' . $post->category . '%');
            })
            ->orderByRaw('CASE WHEN published_at IS NULL THEN 1 ELSE 0 END')
            ->orderBy('published_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
            
        return view('trust.show', compact('post', 'relatedPosts'));
    }
}
