<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtext' => 'nullable|string|max:500',
            'body_content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }

        $validated['is_published'] = $request->has('is_published');

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'hero_title' => 'nullable|string|max:255',
            'hero_subtext' => 'nullable|string|max:500',
            'body_content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($page->hero_image) {
                Storage::disk('public')->delete($page->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }

        $validated['is_published'] = $request->has('is_published');

        $page->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        if ($page->hero_image) {
            Storage::disk('public')->delete($page->hero_image);
        }
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
