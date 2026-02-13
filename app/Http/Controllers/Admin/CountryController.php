<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Journey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        $journeys = Journey::where('is_published', true)->orderBy('title')->get();
        return view('admin.countries.create', compact('journeys'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:countries,slug',
            'hero_image' => 'nullable|image|max:2048',
            'country_narrative' => 'required|string',
            'signature_experiences' => 'nullable|string',
            'conservation_focus' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
            'journeys' => 'nullable|array',
        ]);

        if (!$request->filled('slug')) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('countries', 'public');
        }

        $validated['is_published'] = $request->has('is_published');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $country = Country::create($validated);

        if ($request->has('journeys')) {
            $country->journeys()->sync($request->journeys);
        }

        return redirect()->route('admin.countries.index')->with('success', 'Country created successfully.');
    }

    public function edit(Country $country)
    {
        $journeys = Journey::where('is_published', true)->orderBy('title')->get();
        $selectedJourneys = $country->journeys->pluck('id')->toArray();
        return view('admin.countries.edit', compact('country', 'journeys', 'selectedJourneys'));
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:countries,slug,' . $country->id,
            'hero_image' => 'nullable|image|max:2048',
            'country_narrative' => 'required|string',
            'signature_experiences' => 'nullable|string',
            'conservation_focus' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'is_published' => 'boolean',
            'sort_order' => 'nullable|integer',
            'journeys' => 'nullable|array',
        ]);

        if ($request->hasFile('hero_image')) {
            if ($country->hero_image) {
                Storage::disk('public')->delete($country->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('countries', 'public');
        }

        $validated['is_published'] = $request->has('is_published');

        $country->update($validated);

        if ($request->has('journeys')) {
            $country->journeys()->sync($request->journeys);
        } else {
            $country->journeys()->detach();
        }

        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        if ($country->hero_image) {
            Storage::disk('public')->delete($country->hero_image);
        }
        $country->journeys()->detach();
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }
}
