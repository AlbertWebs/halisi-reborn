<?php

namespace App\Http\Controllers;

use App\Models\HomepageSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
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

        return view('pages.home', compact('heroSection', 'introSection', 'heroCalloutSection', 'experienceSections'));
    }
}
