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
            ->where('journey_category', 'signature-safaris')
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Signature Safaris']);
    }

    public function bespokePrivate()
    {
        $journeys = Journey::where('is_published', true)
            ->where('journey_category', 'bespoke-private-travel')
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Bespoke Private Travel']);
    }

    public function conservationCommunity()
    {
        $journeys = Journey::where('is_published', true)
            ->where('journey_category', 'conservation-community')
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Conservation & Community']);
    }

    public function luxuryRetreats()
    {
        $journeys = Journey::where('is_published', true)
            ->where('journey_category', 'luxury-retreats')
            ->orderBy('sort_order')
            ->get();
        return view('journeys.category', ['journeys' => $journeys, 'category' => 'Luxury Retreats']);
    }

    public function show(Journey $journey)
    {
        return view('journeys.show', compact('journey'));
    }
}
