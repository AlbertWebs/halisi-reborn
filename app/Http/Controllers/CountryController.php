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
        // Get journeys associated with this country
        $journeys = \App\Models\Journey::where('is_published', true)
            ->whereHas('countries', function($query) use ($country) {
                $query->where('countries.id', $country->id);
            })
            ->orderBy('sort_order')
            ->get();
            
        return view('countries.show', compact('country', 'journeys'));
    }

    private function showCountry(string $slug)
    {
        $country = Country::where('slug', $slug)->where('is_published', true)->first();
        
        // If country doesn't exist in DB, create a temporary object with default data
        if (!$country) {
            $countryData = [
                'kenya' => [
                    'name' => 'Kenya',
                    'narrative' => 'Kenya, the heart of safari, offers unparalleled wildlife experiences from the Maasai Mara to the pristine coast. Discover authentic encounters with the Big Five, witness the Great Migration, and connect with Maasai communities while supporting conservation efforts.',
                ],
                'uganda' => [
                    'name' => 'Uganda',
                    'narrative' => 'Uganda, the Pearl of Africa, is home to mountain gorillas, diverse ecosystems, and vibrant cultures. Experience intimate gorilla trekking, explore the source of the Nile, and support community-led conservation initiatives.',
                ],
                'tanzania' => [
                    'name' => 'Tanzania',
                    'narrative' => 'Tanzania offers iconic safari experiences in the Serengeti, Ngorongoro Crater, and beyond. Witness the Great Migration, climb Mount Kilimanjaro, and discover pristine beaches while contributing to conservation and community development.',
                ],
                'zambia' => [
                    'name' => 'Zambia',
                    'narrative' => 'Zambia provides authentic, off-the-beaten-path safari experiences. Explore the Lower Zambezi, walk with lions in South Luangwa, and support community conservation projects in this unspoiled wilderness.',
                ],
                'zimbabwe' => [
                    'name' => 'Zimbabwe',
                    'narrative' => 'Zimbabwe offers world-class wildlife viewing and cultural experiences. Discover Hwange National Park, witness the power of Victoria Falls, and engage with local communities while supporting conservation efforts.',
                ],
                'botswana' => [
                    'name' => 'Botswana',
                    'narrative' => 'Botswana is renowned for its pristine wilderness and exclusive safari experiences. Explore the Okavango Delta, Chobe National Park, and the Kalahari while supporting high-value, low-impact tourism that benefits conservation.',
                ],
                'namibia' => [
                    'name' => 'Namibia',
                    'narrative' => 'Namibia offers dramatic landscapes from the Namib Desert to the Skeleton Coast. Experience unique desert-adapted wildlife, engage with local communities, and support conservation initiatives in this extraordinary country.',
                ],
            ];
            
            $data = $countryData[$slug] ?? [
                'name' => ucfirst($slug),
                'narrative' => 'Content for ' . ucfirst($slug) . ' is coming soon. This page will showcase our authentic journeys and conservation initiatives in this region.',
            ];
            
            $country = new Country([
                'name' => $data['name'],
                'slug' => $slug,
                'country_narrative' => $data['narrative'],
                'is_published' => true,
            ]);
        }
        
        return view('countries.show', compact('country'));
    }
}
