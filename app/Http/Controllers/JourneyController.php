<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Illuminate\Http\Request;

class JourneyController extends Controller
{
    public function index()
    {
        $journeys = Journey::where('is_published', true)->orderBy('sort_order')->get();
        return view('journeys.index', compact('journeys'));
    }

    public function signatureSafaris()
    {
        $journeys = Journey::where('is_published', true)
            ->where(function ($q) {
                $q->whereHas('category', fn ($q2) => $q2->where('slug', 'signature-safaris'))
                    ->orWhere('journey_category', 'Signature Safaris');
            })
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Signature Safaris']);
    }

    public function bespokePrivate()
    {
        $journeys = Journey::where('is_published', true)
            ->where(function ($q) {
                $q->whereHas('category', fn ($q2) => $q2->where('slug', 'bespoke-private-travel'))
                    ->orWhere('journey_category', 'Bespoke Private Travel');
            })
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Bespoke Private Travel']);
    }

    public function conservationCommunity()
    {
        $journeys = Journey::where('is_published', true)
            ->where(function ($q) {
                $q->whereHas('category', fn ($q2) => $q2->where('slug', 'conservation-community'))
                    ->orWhere('journey_category', 'Conservation & Community');
            })
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Conservation & Community']);
    }

    public function luxuryRetreats()
    {
        $journeys = Journey::where('is_published', true)
            ->where(function ($q) {
                $q->whereHas('category', fn ($q2) => $q2->where('slug', 'luxury-retreats'))
                    ->orWhere('journey_category', 'Luxury Retreats');
            })
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Luxury Retreats']);
    }

    public function show(Journey $journey)
    {
        return view('journeys.show', compact('journey'));
    }
}
