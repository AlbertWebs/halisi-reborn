<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::where('is_published', true)->orderBy('sort_order')->get();
        return view('countries.index', compact('countries'));
    }

    public function kenya()
    {
        return $this->showCountry('kenya');
    }

    public function uganda()
    {
        return $this->showCountry('uganda');
    }

    public function tanzania()
    {
        return $this->showCountry('tanzania');
    }

    public function zambia()
    {
        return $this->showCountry('zambia');
    }

    public function zimbabwe()
    {
        return $this->showCountry('zimbabwe');
    }

    public function botswana()
    {
        return $this->showCountry('botswana');
    }

    public function namibia()
    {
        return $this->showCountry('namibia');
    }

    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    private function showCountry(string $slug)
    {
        $country = Country::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('countries.show', compact('country'));
    }
}
