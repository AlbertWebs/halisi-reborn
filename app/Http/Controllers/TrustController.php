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

        $featuredPost = TrustPost::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->first();
            
        $posts = TrustPost::where('is_published', true)
            ->when($featuredPost, function($query) use ($featuredPost) {
                $query->where('id', '!=', $featuredPost->id);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(9);
            
        return view('trust.index', compact('posts', 'featuredPost', 'page'));
    }

    public function show(TrustPost $post)
    {
        $relatedPosts = TrustPost::where('is_published', true)
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                $query->where('category', $post->category)
                    ->orWhere('category', 'like', '%' . $post->category . '%');
            })
            ->limit(3)
            ->get();
            
        return view('trust.show', compact('post', 'relatedPosts'));
    }
}
