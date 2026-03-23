<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryHighlight;
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
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'hero_video' => 'nullable|string|max:500',
            'hero_subtitle' => 'nullable|string',
            'narrative_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'country_narrative' => 'required|string',
            'signature_experiences' => 'nullable|string',
            'destination_brief_lead' => 'nullable|string',
            'destination_brief_capital' => 'nullable|string|max:255',
            'destination_brief_currency' => 'nullable|string|max:255',
            'destination_brief_languages' => 'nullable|string|max:255',
            'destination_brief_time_zone' => 'nullable|string|max:255',
            'destination_brief_airports' => 'nullable|string|max:255',
            'destination_brief_best_for' => 'nullable|string|max:255',
            'destination_brief_ideal_trip_length' => 'nullable|string|max:255',
            'destination_brief_best_time' => 'nullable|string|max:255',
            'destination_brief_travel_style' => 'nullable|string|max:255',
            'destination_brief_ecosystems' => 'nullable|string|max:255',
            'destination_brief_entry_requirements' => 'nullable|string|max:255',
            'destination_brief_health_notes' => 'nullable|string|max:255',
            'destination_brief_climate_intro' => 'nullable|string',
            'destination_brief_climate_1_season' => 'nullable|string|max:255',
            'destination_brief_climate_1_note' => 'nullable|string|max:255',
            'destination_brief_climate_2_season' => 'nullable|string|max:255',
            'destination_brief_climate_2_note' => 'nullable|string|max:255',
            'destination_brief_climate_3_season' => 'nullable|string|max:255',
            'destination_brief_climate_3_note' => 'nullable|string|max:255',
            'highlights_title' => 'nullable|string|max:255',
            'highlight_1_title' => 'nullable|string|max:255',
            'highlight_1_text' => 'nullable|string',
            'highlight_1_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'highlight_2_title' => 'nullable|string|max:255',
            'highlight_2_text' => 'nullable|string',
            'highlight_2_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'highlight_3_title' => 'nullable|string|max:255',
            'highlight_3_text' => 'nullable|string',
            'highlight_3_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'highlight_4_title' => 'nullable|string|max:255',
            'highlight_4_text' => 'nullable|string',
            'highlight_4_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_experiences_title' => 'nullable|string|max:255',
            'signature_card_1_label' => 'nullable|string|max:255',
            'signature_card_1_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_1_video' => 'nullable|string|max:500',
            'signature_card_2_label' => 'nullable|string|max:255',
            'signature_card_2_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_2_video' => 'nullable|string|max:500',
            'signature_card_3_label' => 'nullable|string|max:255',
            'signature_card_3_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_3_video' => 'nullable|string|max:500',
            'signature_card_4_label' => 'nullable|string|max:255',
            'signature_card_4_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_4_video' => 'nullable|string|max:500',
            'conservation_focus' => 'nullable|string',
            'conservation_title' => 'nullable|string|max:255',
            'conservation_visual_text' => 'nullable|string',
            'conservation_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'conservation_button_text' => 'nullable|string|max:255',
            'conservation_button_link' => 'nullable|string|max:500',
            'featured_journeys_title' => 'nullable|string|max:255',
            'featured_journeys_button_text' => 'nullable|string|max:255',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:255',
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

        if ($request->hasFile('narrative_image')) {
            $validated['narrative_image'] = $request->file('narrative_image')->store('countries', 'public');
        }

        foreach (['1', '2', '3', '4'] as $i) {
            if ($request->hasFile("signature_card_{$i}_image")) {
                $validated["signature_card_{$i}_image"] = $request->file("signature_card_{$i}_image")->store('countries', 'public');
            }
        }
        foreach (['1', '2', '3', '4'] as $i) {
            if ($request->hasFile("highlight_{$i}_image")) {
                $validated["highlight_{$i}_image"] = $request->file("highlight_{$i}_image")->store('countries', 'public');
            }
        }

        if ($request->hasFile('conservation_image')) {
            $validated['conservation_image'] = $request->file('conservation_image')->store('countries', 'public');
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

    public function editDestinationBrief(Country $country)
    {
        $country->load('highlights');
        $destinationDefaults = $this->destinationDefaultsForCountry($country);
        $highlightDefaults = $this->highlightDefaultsForCountry($country);
        if ($country->highlights->isEmpty()) {
            foreach ($highlightDefaults as $idx => $default) {
                $legacyTitle = $country->{'highlight_' . ($idx + 1) . '_title'};
                $legacyText = $country->{'highlight_' . ($idx + 1) . '_text'};
                $legacyImage = $country->{'highlight_' . ($idx + 1) . '_image'};

                if (filled($legacyTitle) || filled($legacyText) || filled($legacyImage) || filled($default['title'] ?? null) || filled($default['text'] ?? null)) {
                    $country->highlights->push(new CountryHighlight([
                        'title' => $legacyTitle ?: ($default['title'] ?? null),
                        'text' => $legacyText ?: ($default['text'] ?? null),
                        'image' => $legacyImage,
                        'sort_order' => $idx,
                    ]));
                }
            }
        }
        return view('admin.countries.destination-brief', compact('country', 'highlightDefaults', 'destinationDefaults'));
    }

    public function updateDestinationBrief(Request $request, Country $country)
    {
        $validated = $request->validate([
            'destination_brief_lead' => 'nullable|string',
            'destination_brief_capital' => 'nullable|string|max:255',
            'destination_brief_currency' => 'nullable|string|max:255',
            'destination_brief_languages' => 'nullable|string|max:255',
            'destination_brief_time_zone' => 'nullable|string|max:255',
            'destination_brief_airports' => 'nullable|string|max:255',
            'destination_brief_best_for' => 'nullable|string|max:255',
            'destination_brief_ideal_trip_length' => 'nullable|string|max:255',
            'destination_brief_best_time' => 'nullable|string|max:255',
            'destination_brief_travel_style' => 'nullable|string|max:255',
            'destination_brief_ecosystems' => 'nullable|string|max:255',
            'destination_brief_entry_requirements' => 'nullable|string|max:255',
            'destination_brief_health_notes' => 'nullable|string|max:255',
            'destination_brief_climate_intro' => 'nullable|string',
            'destination_brief_climate_1_season' => 'nullable|string|max:255',
            'destination_brief_climate_1_note' => 'nullable|string|max:255',
            'destination_brief_climate_2_season' => 'nullable|string|max:255',
            'destination_brief_climate_2_note' => 'nullable|string|max:255',
            'destination_brief_climate_3_season' => 'nullable|string|max:255',
            'destination_brief_climate_3_note' => 'nullable|string|max:255',
            'highlights_title' => 'nullable|string|max:255',
            'highlights' => 'nullable|array',
            'highlights.*.id' => 'nullable|integer|exists:country_highlights,id',
            'highlights.*.title' => 'nullable|string|max:255',
            'highlights.*.text' => 'nullable|string',
            'highlights.*.image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'highlights.*._delete' => 'nullable|in:0,1',
        ]);

        $country->update($validated);
        $this->syncCountryHighlights($request, $country);

        return redirect()
            ->route('admin.countries.destination-brief.edit', $country)
            ->with('success', 'Destination brief and highlights updated successfully.');
    }

    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:countries,slug,' . $country->id,
            'hero_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'hero_video' => 'nullable|string|max:500',
            'hero_subtitle' => 'nullable|string',
            'narrative_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'country_narrative' => 'required|string',
            'signature_experiences' => 'nullable|string',
            'destination_brief_lead' => 'nullable|string',
            'destination_brief_capital' => 'nullable|string|max:255',
            'destination_brief_currency' => 'nullable|string|max:255',
            'destination_brief_languages' => 'nullable|string|max:255',
            'destination_brief_time_zone' => 'nullable|string|max:255',
            'destination_brief_airports' => 'nullable|string|max:255',
            'destination_brief_best_for' => 'nullable|string|max:255',
            'destination_brief_ideal_trip_length' => 'nullable|string|max:255',
            'destination_brief_best_time' => 'nullable|string|max:255',
            'destination_brief_travel_style' => 'nullable|string|max:255',
            'destination_brief_ecosystems' => 'nullable|string|max:255',
            'destination_brief_entry_requirements' => 'nullable|string|max:255',
            'destination_brief_health_notes' => 'nullable|string|max:255',
            'destination_brief_climate_intro' => 'nullable|string',
            'destination_brief_climate_1_season' => 'nullable|string|max:255',
            'destination_brief_climate_1_note' => 'nullable|string|max:255',
            'destination_brief_climate_2_season' => 'nullable|string|max:255',
            'destination_brief_climate_2_note' => 'nullable|string|max:255',
            'destination_brief_climate_3_season' => 'nullable|string|max:255',
            'destination_brief_climate_3_note' => 'nullable|string|max:255',
            'highlights_title' => 'nullable|string|max:255',
            'highlight_1_title' => 'nullable|string|max:255',
            'highlight_1_text' => 'nullable|string',
            'highlight_1_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'highlight_2_title' => 'nullable|string|max:255',
            'highlight_2_text' => 'nullable|string',
            'highlight_2_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'highlight_3_title' => 'nullable|string|max:255',
            'highlight_3_text' => 'nullable|string',
            'highlight_3_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'highlight_4_title' => 'nullable|string|max:255',
            'highlight_4_text' => 'nullable|string',
            'highlight_4_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_experiences_title' => 'nullable|string|max:255',
            'signature_card_1_label' => 'nullable|string|max:255',
            'signature_card_1_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_1_video' => 'nullable|string|max:500',
            'signature_card_2_label' => 'nullable|string|max:255',
            'signature_card_2_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_2_video' => 'nullable|string|max:500',
            'signature_card_3_label' => 'nullable|string|max:255',
            'signature_card_3_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_3_video' => 'nullable|string|max:500',
            'signature_card_4_label' => 'nullable|string|max:255',
            'signature_card_4_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'signature_card_4_video' => 'nullable|string|max:500',
            'conservation_focus' => 'nullable|string',
            'conservation_title' => 'nullable|string|max:255',
            'conservation_visual_text' => 'nullable|string',
            'conservation_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'conservation_button_text' => 'nullable|string|max:255',
            'conservation_button_link' => 'nullable|string|max:500',
            'featured_journeys_title' => 'nullable|string|max:255',
            'featured_journeys_button_text' => 'nullable|string|max:255',
            'cta_label' => 'nullable|string|max:255',
            'cta_link' => 'nullable|string|max:255',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:255',
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

        if ($request->hasFile('narrative_image')) {
            if ($country->narrative_image) {
                Storage::disk('public')->delete($country->narrative_image);
            }
            $validated['narrative_image'] = $request->file('narrative_image')->store('countries', 'public');
        }

        foreach (['1', '2', '3', '4'] as $i) {
            $key = "signature_card_{$i}_image";
            if ($request->hasFile($key)) {
                if ($country->$key) {
                    Storage::disk('public')->delete($country->$key);
                }
                $validated[$key] = $request->file($key)->store('countries', 'public');
            }
        }
        foreach (['1', '2', '3', '4'] as $i) {
            $key = "highlight_{$i}_image";
            if ($request->hasFile($key)) {
                if ($country->$key) {
                    Storage::disk('public')->delete($country->$key);
                }
                $validated[$key] = $request->file($key)->store('countries', 'public');
            }
        }

        if ($request->hasFile('conservation_image')) {
            if ($country->conservation_image) {
                Storage::disk('public')->delete($country->conservation_image);
            }
            $validated['conservation_image'] = $request->file('conservation_image')->store('countries', 'public');
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
        if ($country->narrative_image) {
            Storage::disk('public')->delete($country->narrative_image);
        }
        foreach (['1', '2', '3', '4'] as $i) {
            $key = "signature_card_{$i}_image";
            if ($country->$key) {
                Storage::disk('public')->delete($country->$key);
            }
        }
        foreach (['1', '2', '3', '4'] as $i) {
            $key = "highlight_{$i}_image";
            if ($country->$key) {
                Storage::disk('public')->delete($country->$key);
            }
        }
        foreach ($country->highlights as $highlight) {
            if (filled($highlight->image)) {
                Storage::disk('public')->delete($highlight->image);
            }
        }
        if ($country->conservation_image) {
            Storage::disk('public')->delete($country->conservation_image);
        }
        $country->journeys()->detach();
        $country->delete();

        return redirect()->route('admin.countries.index')->with('success', 'Country deleted successfully.');
    }

    private function highlightDefaultsForCountry(Country $country): array
    {
        $highlightDefaultsBySlug = [
            'tanzania' => [
                ['title' => 'Mount Kilimanjaro', 'text' => "Africa's highest peak at 5,895m, with distinct ecological zones as you ascend."],
                ['title' => 'Ngorongoro Crater', 'text' => 'A vast intact caldera and one of East Africa\'s richest wildlife habitats.'],
                ['title' => 'Serengeti', 'text' => 'Predator-rich plains and the famed Great Migration corridors.'],
                ['title' => 'Zanzibar Archipelago', 'text' => 'Spice routes, coral reefs, and a refined coast-and-safari pairing.'],
            ],
            'kenya' => [
                ['title' => 'Maasai Mara', 'text' => 'Classic big-cat territory and migration crossings.'],
                ['title' => 'Amboseli', 'text' => 'Elephant herds set beneath Kilimanjaro views.'],
                ['title' => 'Laikipia', 'text' => 'Conservancy-led wilderness and strong community partnerships.'],
                ['title' => 'Kenya Coast', 'text' => 'Swahili heritage, marine life, and restorative beach retreats.'],
            ],
        ];

        return $highlightDefaultsBySlug[$country->slug] ?? [
            ['title' => 'Iconic wilderness', 'text' => 'Protected landscapes where biodiversity remains central to the experience.'],
            ['title' => 'Cultural depth', 'text' => 'Host-led encounters grounded in respect, context, and exchange.'],
            ['title' => 'Conservation models', 'text' => 'Journeys linked to long-term habitat and community outcomes.'],
            ['title' => 'Refined stays', 'text' => 'Properties selected for character, comfort, and place-based design.'],
        ];
    }

    private function destinationDefaultsForCountry(Country $country): array
    {
        $defaultsBySlug = [
            'tanzania' => [
                'lead' => 'A country of vast plains, iconic wildlife corridors, and Indian Ocean islands framed by coral reefs and Swahili heritage.',
                'capital' => 'Dodoma',
                'currency' => 'Tanzanian Shilling',
                'languages' => 'Swahili and English',
                'airports' => 'Julius Nyerere (DAR), Kilimanjaro (JRO), Abeid Amani Karume (ZNZ)',
                'time_zone' => 'East Africa Time (UTC+3)',
                'best_for' => 'Great Migration, crater safaris, coast + island retreats',
                'ideal_trip_length' => '8-14 nights',
                'best_time' => 'Jun-Oct for dry season safaris; Jan-Mar for calving landscapes',
                'entry' => 'Visa and entry policy depend on nationality',
                'health' => 'Travel insurance and pre-travel health guidance recommended',
                'style' => 'Private fly-in circuits or overland combinations',
                'ecosystems' => 'Savanna plains, volcanic highlands, Rift Valley, coral islands',
                'climate_intro' => 'Tropical on the coast and islands, temperate in most parks, with hotter conditions between October and March.',
                'climate' => [
                    ['season' => 'Dec - Mar', 'note' => 'Hot dry season, strong beach conditions.'],
                    ['season' => 'Apr - May', 'note' => 'Long rains, lush landscapes, fewer crowds.'],
                    ['season' => 'Jun - Nov', 'note' => 'Cooler dry season, excellent safari viewing.'],
                ],
            ],
            'kenya' => [
                'lead' => 'From the Maasai Mara and Amboseli to the Indian Ocean coast, Kenya blends iconic safaris with deeply rooted cultural heritage.',
                'capital' => 'Nairobi',
                'currency' => 'Kenyan Shilling',
                'languages' => 'Swahili and English',
                'airports' => 'Jomo Kenyatta (NBO), Moi (MBA), Kisumu (KIS)',
                'time_zone' => 'East Africa Time (UTC+3)',
                'best_for' => 'Big-cat safaris, conservancy travel, coast extensions',
                'ideal_trip_length' => '7-12 nights',
                'best_time' => 'Jun-Oct for classic game viewing; Jan-Mar for warm dry travel',
                'entry' => 'Visa and entry policy depend on nationality',
                'health' => 'Travel insurance and pre-travel health guidance recommended',
                'style' => 'Conservancy-led safaris with optional beach finish',
                'ecosystems' => 'Savanna, highlands, lakes, and Indian Ocean coastline',
                'climate_intro' => 'Generally warm with regional variation by altitude; dry windows often deliver the best game concentration.',
                'climate' => [
                    ['season' => 'Jan - Mar', 'note' => 'Warm and mostly dry, ideal for mixed safari routes.'],
                    ['season' => 'Apr - May', 'note' => 'Long rains, dramatic skies, rich green landscapes.'],
                    ['season' => 'Jun - Oct', 'note' => 'Cooler dry season, prime for wildlife movement.'],
                ],
            ],
        ];

        return $defaultsBySlug[$country->slug] ?? [
            'lead' => '',
            'capital' => '',
            'currency' => '',
            'languages' => '',
            'airports' => '',
            'time_zone' => 'East Africa Time (UTC+3)',
            'best_for' => '',
            'ideal_trip_length' => '',
            'best_time' => '',
            'entry' => 'Check latest rules for your passport before departure',
            'health' => 'Travel insurance and pre-travel health guidance recommended',
            'style' => 'Private, tailored journeys',
            'ecosystems' => '',
            'climate_intro' => 'Conditions vary by region and elevation; we tailor timing around your preferred experience and pace.',
            'climate' => [
                ['season' => 'Dry window', 'note' => 'Excellent for game viewing and overland movement.'],
                ['season' => 'Green window', 'note' => 'Richer landscapes and strong photographic contrast.'],
                ['season' => 'Shoulder period', 'note' => 'Balanced conditions with fewer travellers.'],
            ],
        ];
    }

    private function syncCountryHighlights(Request $request, Country $country): void
    {
        $rows = $request->input('highlights', []);
        $files = $request->file('highlights', []);
        $existing = $country->highlights()->get()->keyBy('id');
        $seen = [];

        foreach ($rows as $index => $row) {
            $id = isset($row['id']) ? (int) $row['id'] : null;
            $toDelete = (string) ($row['_delete'] ?? '0') === '1';

            if ($id && !$existing->has($id)) {
                continue;
            }

            if ($toDelete) {
                if ($id) {
                    $item = $existing->get($id);
                    if ($item && filled($item->image)) {
                        Storage::disk('public')->delete($item->image);
                    }
                    $country->highlights()->whereKey($id)->delete();
                }
                continue;
            }

            $title = trim((string) ($row['title'] ?? ''));
            $text = trim((string) ($row['text'] ?? ''));
            $uploadedFile = $files[$index]['image'] ?? null;

            if ($id) {
                $item = $existing->get($id);
                $payload = [
                    'title' => $title !== '' ? $title : null,
                    'text' => $text !== '' ? $text : null,
                    'sort_order' => count($seen),
                ];

                if ($uploadedFile) {
                    if (filled($item->image)) {
                        Storage::disk('public')->delete($item->image);
                    }
                    $payload['image'] = $uploadedFile->store('countries', 'public');
                }

                if (filled($payload['title']) || filled($payload['text']) || filled($item->image) || isset($payload['image'])) {
                    $item->update($payload);
                    $seen[] = $id;
                } else {
                    if (filled($item->image)) {
                        Storage::disk('public')->delete($item->image);
                    }
                    $item->delete();
                }
                continue;
            }

            if ($title === '' && $text === '' && !$uploadedFile) {
                continue;
            }

            $country->highlights()->create([
                'title' => $title !== '' ? $title : null,
                'text' => $text !== '' ? $text : null,
                'image' => $uploadedFile ? $uploadedFile->store('countries', 'public') : null,
                'sort_order' => count($seen),
            ]);
        }
    }
}
