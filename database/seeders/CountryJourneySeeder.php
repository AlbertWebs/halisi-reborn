<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Journey;
use Illuminate\Database\Seeder;

class CountryJourneySeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'kenya' => ['kenya-signature-safari'],
            'uganda' => ['uganda-gorilla-forest-journey'],
            'tanzania' => ['tanzania-migration-expedition'],
            'botswana' => ['botswana-delta-luxury-retreat'],
            'namibia' => ['namibia-desert-coast-escape'],
            'zambia' => ['zimbabwe-zambia-river-adventure'],
            'zimbabwe' => ['zimbabwe-zambia-river-adventure'],
        ];

        foreach ($map as $countrySlug => $journeySlugs) {
            $country = Country::where('slug', $countrySlug)->first();
            if (!$country) {
                continue;
            }

            $journeyIds = Journey::whereIn('slug', $journeySlugs)->pluck('id')->all();
            if (count($journeyIds) > 0) {
                $country->journeys()->syncWithoutDetaching($journeyIds);
            }
        }
    }
}
