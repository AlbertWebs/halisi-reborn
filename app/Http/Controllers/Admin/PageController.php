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
            'content_image_1' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'content_image_2' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'featured_label' => 'nullable|string|max:255',
            'latest_articles_title' => 'nullable|string|max:255',
            'latest_articles_description' => 'nullable|string|max:500',
            'empty_state_message' => 'nullable|string|max:500',
            'contact_section_title' => 'nullable|string|max:255',
            'contact_section_intro' => 'nullable|string|max:1000',
            'contact_form_title' => 'nullable|string|max:255',
            'contact_form_intro' => 'nullable|string|max:1000',
            'contact_form_button_label' => 'nullable|string|max:255',
            'contact_map_embed_url' => 'nullable|string|max:2000',
            'contact_email_label' => 'nullable|string|max:255',
            'contact_phone_label' => 'nullable|string|max:255',
            'contact_address_label' => 'nullable|string|max:255',
            'contact_hours_label' => 'nullable|string|max:255',
            'contact_social_label' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }
        if ($request->hasFile('content_image_1')) {
            $validated['content_image_1'] = $request->file('content_image_1')->store('pages', 'public');
        }
        if ($request->hasFile('content_image_2')) {
            $validated['content_image_2'] = $request->file('content_image_2')->store('pages', 'public');
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
            'content_image_1' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'content_image_2' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'featured_label' => 'nullable|string|max:255',
            'latest_articles_title' => 'nullable|string|max:255',
            'latest_articles_description' => 'nullable|string|max:500',
            'empty_state_message' => 'nullable|string|max:500',
            'contact_section_title' => 'nullable|string|max:255',
            'contact_section_intro' => 'nullable|string|max:1000',
            'contact_form_title' => 'nullable|string|max:255',
            'contact_form_intro' => 'nullable|string|max:1000',
            'contact_form_button_label' => 'nullable|string|max:255',
            'contact_map_embed_url' => 'nullable|string|max:2000',
            'contact_email_label' => 'nullable|string|max:255',
            'contact_phone_label' => 'nullable|string|max:255',
            'contact_address_label' => 'nullable|string|max:255',
            'contact_hours_label' => 'nullable|string|max:255',
            'contact_social_label' => 'nullable|string|max:255',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($page->hero_image) {
                Storage::disk('public')->delete($page->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('pages', 'public');
        }
        if ($request->hasFile('content_image_1')) {
            if ($page->content_image_1) {
                Storage::disk('public')->delete($page->content_image_1);
            }
            $validated['content_image_1'] = $request->file('content_image_1')->store('pages', 'public');
        }
        if ($request->hasFile('content_image_2')) {
            if ($page->content_image_2) {
                Storage::disk('public')->delete($page->content_image_2);
            }
            $validated['content_image_2'] = $request->file('content_image_2')->store('pages', 'public');
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
        if ($page->content_image_1) {
            Storage::disk('public')->delete($page->content_image_1);
        }
        if ($page->content_image_2) {
            Storage::disk('public')->delete($page->content_image_2);
        }
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
