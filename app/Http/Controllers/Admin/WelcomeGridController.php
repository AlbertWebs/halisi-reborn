<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WelcomeGridController extends Controller
{
    /**
     * @return array<string, array{title: string, sort_order: int, help: string}>
     */
    public static function tileDefinitions(): array
    {
        return [
            'welcome_grid_culture' => [
                'title' => 'Culture',
                'sort_order' => 20,
                'help' => 'Top-left. If no image, uses the “pillar_culture” homepage image.',
            ],
            'welcome_grid_community' => [
                'title' => 'Community',
                'sort_order' => 21,
                'help' => 'Top-right. If no image, uses “pillar_community”.',
            ],
            'welcome_grid_conservation' => [
                'title' => 'Conservation',
                'sort_order' => 22,
                'help' => 'Bottom-left. If no image, uses “pillar_conservation”.',
            ],
            'welcome_grid_climate' => [
                'title' => 'Climate',
                'sort_order' => 23,
                'help' => 'Bottom-right. If no image, uses “pillar_climate_action”.',
            ],
        ];
    }

    public function edit()
    {
        foreach (self::tileDefinitions() as $key => $defaults) {
            HomepageSection::firstOrCreate(
                ['section_key' => $key],
                [
                    'title' => $defaults['title'],
                    'sort_order' => $defaults['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        $keys = array_keys(self::tileDefinitions());
        $tiles = HomepageSection::whereIn('section_key', $keys)
            ->get()
            ->keyBy('section_key');

        return view('admin.homepage.welcome-grid', [
            'tileKeys' => $keys,
            'tiles' => $tiles,
            'definitions' => self::tileDefinitions(),
        ]);
    }

    public function update(Request $request)
    {
        $keys = array_keys(self::tileDefinitions());

        $imageRules = [];
        foreach ($keys as $key) {
            $imageRules['image_'.$key] = ['nullable', 'file', 'image', 'mimes:jpeg,jpg,png,gif,webp,avif', 'max:10240'];
        }

        $request->validate(array_merge([
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string|max:255',
            'cta_links' => 'nullable|array',
            'cta_links.*' => 'nullable|string|max:500',
            'remove_image' => 'nullable|array',
            'remove_image.*' => 'nullable|boolean',
        ], $imageRules));

        foreach ($keys as $key) {
            $section = HomepageSection::where('section_key', $key)->first();
            if (! $section) {
                continue;
            }

            if ($request->boolean('remove_image.'.$key)) {
                if ($section->image && ! Str::startsWith($section->image, ['http://', 'https://'])) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = null;
            }

            $fileKey = 'image_'.$key;
            if ($request->hasFile($fileKey)) {
                if ($section->image && ! Str::startsWith($section->image, ['http://', 'https://'])) {
                    Storage::disk('public')->delete($section->image);
                }
                $section->image = $request->file($fileKey)->store('homepage', 'public');
            }

            if ($request->has('titles')) {
                $title = $request->input('titles.'.$key);
                if (is_string($title)) {
                    $section->title = $title !== '' ? $title : null;
                }
            }

            if ($request->has('cta_links')) {
                $link = $request->input('cta_links.'.$key);
                $section->cta_link = is_string($link) && $link !== '' ? $link : null;
            }

            $section->save();
        }

        return redirect()
            ->route('admin.homepage.welcome-grid.edit')
            ->with('success', 'Welcome section grid updated.');
    }
}
