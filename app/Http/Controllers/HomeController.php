<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\HomepageSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $exploreCountries = Country::where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
        $heroSection = HomepageSection::where('section_key', 'hero')
            ->where('is_active', true)
            ->first();

        $introSection = HomepageSection::where('section_key', 'intro')
            ->where('is_active', true)
            ->first();

        $heroCalloutSection = HomepageSection::where('section_key', 'hero_callout')
            ->where('is_active', true)
            ->first();

        $experienceSections = HomepageSection::whereIn('section_key', [
                'experience_safaris',
                'experience_luxury',
                'experience_community',
            ])
            ->where('is_active', true)
            ->get()
            ->keyBy('section_key');

        $pillarSections = HomepageSection::whereIn('section_key', [
                'pillar_culture',
                'pillar_community',
                'pillar_conservation',
                'pillar_change_agents',
                'pillar_climate_action',
            ])
            ->where('is_active', true)
            ->get()
            ->keyBy('section_key');

        $responsibleTravelSection = HomepageSection::where('section_key', 'responsible_travel_teaser')
            ->where('is_active', true)
            ->first();

        $womenRestorationSection = HomepageSection::where('section_key', 'women_restoration_teaser')
            ->where('is_active', true)
            ->first();

        return view('pages.home', compact(
            'heroSection',
            'introSection',
            'heroCalloutSection',
            'experienceSections',
            'pillarSections',
            'responsibleTravelSection',
            'womenRestorationSection',
            'exploreCountries'
        ));
    }
}
