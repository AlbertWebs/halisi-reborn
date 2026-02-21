<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TrustController extends Controller
{
    public function index()
    {
        $posts = TrustPost::orderBy('published_at', 'desc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.trust.index', compact('posts'));
    }

    public function create()
    {
        $categories = ['Field Stories', 'Community Voices', 'Conservation & Climate', 'Regenerative Tourism Reflections'];
        return view('admin.trust.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:trust_posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'category' => 'required|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('trust', 'public');
        }

        if ($request->filled('published_at')) {
            $validated['published_at'] = Carbon::parse($request->published_at);
        }

        TrustPost::create($validated);

        return redirect()->route('admin.trust.index')->with('success', 'Article created successfully.');
    }

    public function edit(TrustPost $trust)
    {
        $categories = ['Field Stories', 'Community Voices', 'Conservation & Climate', 'Regenerative Tourism Reflections'];
        return view('admin.trust.edit', compact('trust', 'categories'));
    }

    public function update(Request $request, TrustPost $trust)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:trust_posts,slug,' . $trust->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'category' => 'required|string|max:255',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($trust->featured_image) {
                Storage::disk('public')->delete($trust->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('trust', 'public');
        }

        if ($request->filled('published_at')) {
            $validated['published_at'] = Carbon::parse($request->published_at);
        } elseif ($request->has('published_at') && !$request->filled('published_at')) {
            $validated['published_at'] = null;
        }

        $trust->update($validated);

        return redirect()->route('admin.trust.index')->with('success', 'Article updated successfully.');
    }

    public function destroy(TrustPost $trust)
    {
        if ($trust->featured_image) {
            Storage::disk('public')->delete($trust->featured_image);
        }
        $trust->delete();

        return redirect()->route('admin.trust.index')->with('success', 'Article deleted successfully.');
    }
}
