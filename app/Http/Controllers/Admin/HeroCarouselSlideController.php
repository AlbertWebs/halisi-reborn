<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroCarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroCarouselSlideController extends Controller
{
    public function index()
    {
        $slides = HeroCarouselSlide::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.hero-carousel.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-carousel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'file', 'image', 'mimes:jpeg,jpg,png,gif,webp,avif', 'max:10240'],
            'image_alt' => 'nullable|string|max:255',
            'overlay_title' => 'nullable|string|max:255',
            'overlay_subtitle' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'image.required' => 'Please choose an image file to upload.',
            'image.image' => 'The file must be a valid image (JPEG, PNG, GIF, WebP, or AVIF).',
            'image.max' => 'The image may not be greater than 10 MB. If it still fails, increase upload_max_filesize and post_max_size in php.ini.',
        ]);

        $file = $request->file('image');
        if (! $file || ! $file->isValid()) {
            return back()
                ->withInput()
                ->withErrors(['image' => 'Upload failed. Check PHP limits (upload_max_filesize, post_max_size) and try a smaller file.']);
        }

        $validated['image'] = $file->store('hero-carousel', 'public');
        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        HeroCarouselSlide::create($validated);

        return redirect()->route('admin.hero-carousel.index')->with('success', 'Slide added.');
    }

    public function edit(HeroCarouselSlide $slide)
    {
        return view('admin.hero-carousel.edit', compact('slide'));
    }

    public function update(Request $request, HeroCarouselSlide $slide)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif,webp,avif', 'max:10240'],
            'image_alt' => 'nullable|string|max:255',
            'overlay_title' => 'nullable|string|max:255',
            'overlay_subtitle' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
        ], [
            'image.image' => 'The file must be a valid image (JPEG, PNG, GIF, WebP, or AVIF).',
            'image.max' => 'The image may not be greater than 10 MB.',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if (! $file->isValid()) {
                return back()
                    ->withInput()
                    ->withErrors(['image' => 'Upload failed. Check PHP limits or try a smaller file.']);
            }
            if ($slide->image) {
                Storage::disk('public')->delete($slide->image);
            }
            $validated['image'] = $file->store('hero-carousel', 'public');
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $slide->update($validated);

        return redirect()->route('admin.hero-carousel.index')->with('success', 'Slide updated.');
    }

    public function destroy(HeroCarouselSlide $slide)
    {
        if ($slide->image) {
            Storage::disk('public')->delete($slide->image);
        }
        $slide->delete();

        return redirect()->route('admin.hero-carousel.index')->with('success', 'Slide deleted.');
    }
}
