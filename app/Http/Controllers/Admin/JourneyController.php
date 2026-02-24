<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Journey;
use App\Models\JourneyImage;
use App\Models\JourneyItinerary;
use App\Models\Country;
use App\Models\JourneyCategory;
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
        $categories = JourneyCategory::orderBy('sort_order')->orderBy('name')->get();
        return view('admin.journeys.create', compact('countries', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journeys,slug',
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp,avif|max:2048',
            'hero_video' => 'nullable|string|max:500',
            'narrative_intro' => 'required|string',
            'experience_highlights' => 'nullable|string',
            'regenerative_impact' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'journey_category_id' => 'required|exists:journey_categories,id',
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

        $category = JourneyCategory::findOrFail($validated['journey_category_id']);
        $validated['journey_category'] = $category->name;
        if ($request->filled('hero_video')) {
            $validated['hero_video'] = $request->hero_video;
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
        $categories = JourneyCategory::orderBy('sort_order')->orderBy('name')->get();
        $selectedCountries = $journey->countries->pluck('id')->toArray();
        return view('admin.journeys.edit', compact('journey', 'countries', 'categories', 'selectedCountries'));
    }

    public function update(Request $request, Journey $journey)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:journeys,slug,' . $journey->id,
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp,avif|max:2048',
            'hero_video' => 'nullable|string|max:500',
            'narrative_intro' => 'required|string',
            'experience_highlights' => 'nullable|string',
            'regenerative_impact' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'journey_category_id' => 'required|exists:journey_categories,id',
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

        $category = JourneyCategory::findOrFail($validated['journey_category_id']);
        $validated['journey_category'] = $category->name;
        $validated['hero_video'] = $request->filled('hero_video') ? $request->hero_video : null;
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
        foreach ($journey->galleryImages as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $journey->countries()->detach();
        $journey->delete();

        return redirect()->route('admin.journeys.index')->with('success', 'Journey deleted successfully.');
    }

    public function addGalleryImages(Request $request, Journey $journey)
    {
        $request->validate([
            'gallery' => 'required|array',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,gif,webp,avif|max:2048',
        ]);

        $maxOrder = (int) $journey->galleryImages()->max('sort_order');
        $created = [];

        foreach ($request->file('gallery') as $file) {
            $path = $file->store('journeys', 'public');
            $maxOrder++;
            $image = $journey->galleryImages()->create([
                'image' => $path,
                'sort_order' => $maxOrder,
            ]);
            $created[] = [
                'id' => $image->id,
                'image' => $image->image,
                'url' => asset('storage/' . $image->image),
            ];
        }

        return response()->json(['success' => true, 'images' => $created]);
    }

    public function destroyGalleryImage(JourneyImage $journey_image)
    {
        Storage::disk('public')->delete($journey_image->image);
        $journey_image->delete();
        return redirect()->back()->with('success', 'Gallery image removed.');
    }

    public function storeItinerary(Request $request, Journey $journey)
    {
        $validated = $request->validate([
            'day' => 'required|integer|min:1|max:365',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        $validated['sort_order'] = (int) $journey->itineraryItems()->max('sort_order') + 1;
        $journey->itineraryItems()->create($validated);
        return redirect()->route('admin.journeys.edit', $journey)->with('success', 'Itinerary day added.');
    }

    public function editItinerary(Journey $journey, JourneyItinerary $itinerary)
    {
        if ($itinerary->journey_id !== $journey->id) {
            abort(404);
        }
        return view('admin.journeys.itinerary-edit', compact('journey', 'itinerary'));
    }

    public function updateItinerary(Request $request, Journey $journey, JourneyItinerary $itinerary)
    {
        if ($itinerary->journey_id !== $journey->id) {
            abort(404);
        }
        $validated = $request->validate([
            'day' => 'required|integer|min:1|max:365',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        $itinerary->update($validated);
        return redirect()->route('admin.journeys.edit', $journey)->with('success', 'Itinerary day updated.');
    }

    public function destroyItinerary(Journey $journey, JourneyItinerary $itinerary)
    {
        if ($itinerary->journey_id !== $journey->id) {
            abort(404);
        }
        $itinerary->delete();
        return redirect()->route('admin.journeys.edit', $journey)->with('success', 'Itinerary day removed.');
    }
}
