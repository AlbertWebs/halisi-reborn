<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journey;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class JourneyController extends Controller
{
    public function index()
    {
        $journeys = Journey::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.journeys.index', compact('journeys'));
    }

    public function create()
    {
        $countries = Country::where('is_published', true)->orderBy('name')->get();
        $categories = ['Signature Safaris', 'Bespoke Private Travel', 'Conservation & Community', 'Luxury Retreats'];
        return view('admin.journeys.create', compact('countries', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journeys,slug',
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'narrative_intro' => 'required|string',
            'experience_highlights' => 'nullable|string',
            'regenerative_impact' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'journey_category' => 'required|string|max:255',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
            'countries' => 'nullable|array',
        ]);

        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('journeys', 'public');
        }

        $validated['is_published'] = $request->has('is_published');

        $journey = Journey::create($validated);

        if ($request->has('countries')) {
            $journey->countries()->sync($request->countries);
        }

        return redirect()->route('admin.journeys.index')->with('success', 'Journey created successfully.');
    }

    public function edit(Journey $journey)
    {
        $countries = Country::where('is_published', true)->orderBy('name')->get();
        $categories = ['Signature Safaris', 'Bespoke Private Travel', 'Conservation & Community', 'Luxury Retreats'];
        $selectedCountries = $journey->countries->pluck('id')->toArray();
        return view('admin.journeys.edit', compact('journey', 'countries', 'categories', 'selectedCountries'));
    }

    public function update(Request $request, Journey $journey)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journeys,slug,' . $journey->id,
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'narrative_intro' => 'required|string',
            'experience_highlights' => 'nullable|string',
            'regenerative_impact' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'journey_category' => 'required|string|max:255',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
            'countries' => 'nullable|array',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($journey->hero_image) {
                Storage::disk('public')->delete($journey->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('journeys', 'public');
        }

        $validated['is_published'] = $request->has('is_published');

        $journey->update($validated);

        if ($request->has('countries')) {
            $journey->countries()->sync($request->countries);
        } else {
            $journey->countries()->detach();
        }

        return redirect()->route('admin.journeys.index')->with('success', 'Journey updated successfully.');
    }

    public function destroy(Journey $journey)
    {
        if ($journey->hero_image) {
            Storage::disk('public')->delete($journey->hero_image);
        }
        $journey->countries()->detach();
        $journey->delete();

        return redirect()->route('admin.journeys.index')->with('success', 'Journey deleted successfully.');
    }
}
