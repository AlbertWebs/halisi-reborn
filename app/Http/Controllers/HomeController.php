<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\HeroCarouselSlide;
use App\Models\HomepageSection;
use App\Models\SiteSetting;
use App\Models\TrustPost;

class HomeController extends Controller
{
    public function index()
    {
        $exploreCountries = Country::where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $heroBackgroundMode = SiteSetting::get('hero_background_mode', 'video');
        $heroVimeoVideoId = SiteSetting::get('hero_vimeo_video_id', '1058906686') ?: '1058906686';
        $heroCarouselIntervalMs = (int) (SiteSetting::get('hero_carousel_interval_ms', '6000') ?: 6000);
        $heroCarouselSlides = HeroCarouselSlide::activeOrdered()->get();
        $useHeroCarousel = $heroBackgroundMode === 'carousel' && $heroCarouselSlides->isNotEmpty();

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

        $welcomeGridSections = HomepageSection::whereIn('section_key', [
            'welcome_grid_culture',
            'welcome_grid_community',
            'welcome_grid_conservation',
            'welcome_grid_climate',
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

        $blogPosts = TrustPost::query()
            ->where('is_published', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit(3)
            ->get();

        return view('pages.home', compact(
            'heroSection',
            'introSection',
            'heroCalloutSection',
            'experienceSections',
            'pillarSections',
            'welcomeGridSections',
            'responsibleTravelSection',
            'womenRestorationSection',
            'blogPosts',
            'exploreCountries',
            'useHeroCarousel',
            'heroCarouselSlides',
            'heroVimeoVideoId',
            'heroCarouselIntervalMs',
        ));
    }
}
