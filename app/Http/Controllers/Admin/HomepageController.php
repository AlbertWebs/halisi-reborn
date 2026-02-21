<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageController extends Controller
{
    public function index()
    {
        $sections = HomepageSection::orderBy('sort_order')->get();
        return view('admin.homepage.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.homepage.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_key' => 'required|string|max:255|unique:homepage_sections,section_key',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('homepage', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        HomepageSection::create($validated);

        return redirect()->route('admin.homepage.index')->with('success', 'Homepage section created successfully.');
    }

    public function edit(HomepageSection $homepage)
    {
        return view('admin.homepage.edit', compact('homepage'));
    }

    public function update(Request $request, HomepageSection $homepage)
    {
        $validated = $request->validate([
            'section_key' => 'required|string|max:255|unique:homepage_sections,section_key,' . $homepage->id,
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->has('remove_image') && $homepage->image) {
            Storage::disk('public')->delete($homepage->image);
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($homepage->image) {
                Storage::disk('public')->delete($homepage->image);
            }
            $validated['image'] = $request->file('image')->store('homepage', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $homepage->update($validated);

        return redirect()->route('admin.homepage.index')->with('success', 'Homepage section updated successfully.');
    }

    public function destroy(HomepageSection $homepage)
    {
        if ($homepage->image) {
            Storage::disk('public')->delete($homepage->image);
        }
        $homepage->delete();

        return redirect()->route('admin.homepage.index')->with('success', 'Homepage section deleted successfully.');
    }
}
