<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journey;
use App\Models\Country;
use Illuminate\Support\Str;

class JourneysSeeder extends Seeder
{
    public function run(): void
    {
        $kenya = Country::where('slug', 'kenya')->first();
        $tanzania = Country::where('slug', 'tanzania')->first();
        $uganda = Country::where('slug', 'uganda')->first();

        $journeys = [
            [
                'title' => 'Great Migration Safari',
                'slug' => 'great-migration-safari',
                'narrative_intro' => 'Experience the world\'s greatest wildlife spectacle as millions of wildebeest and zebra migrate across the Serengeti and Maasai Mara. This journey combines luxury accommodation with front-row seats to nature\'s most dramatic show.',
                'experience_highlights' => '<ul><li>Witness river crossings in the Mara</li><li>Hot air balloon safari over the plains</li><li>Private game drives with expert guides</li><li>Luxury tented camps in prime locations</li></ul>',
                'regenerative_impact' => 'This journey directly supports local Maasai communities through employment, education programs, and conservation initiatives that protect the migration corridors.',
                'journey_category' => 'Signature Safaris',
                'is_published' => true,
                'sort_order' => 1,
                'countries' => [$kenya->id, $tanzania->id],
            ],
            [
                'title' => 'Gorilla & Chimpanzee Encounter',
                'slug' => 'gorilla-chimpanzee-encounter',
                'narrative_intro' => 'An intimate journey into Uganda\'s pristine forests to encounter mountain gorillas and chimpanzees in their natural habitat. This transformative experience supports critical conservation efforts.',
                'experience_highlights' => '<ul><li>Mountain gorilla trekking in Bwindi</li><li>Chimpanzee tracking in Kibale Forest</li><li>Community visits and cultural experiences</li><li>Luxury eco-lodges</li></ul>',
                'regenerative_impact' => 'Every journey contributes to gorilla conservation through permit fees, community revenue sharing, and support for anti-poaching initiatives.',
                'journey_category' => 'Conservation & Community',
                'is_published' => true,
                'sort_order' => 2,
                'countries' => [$uganda->id],
            ],
            [
                'title' => 'Okavango Delta Luxury Safari',
                'slug' => 'okavango-delta-luxury-safari',
                'narrative_intro' => 'Discover the pristine wilderness of the Okavango Delta, one of Africa\'s last great wilderness areas. This exclusive journey combines water-based safaris with luxury accommodation.',
                'experience_highlights' => '<ul><li>Mokoro (dugout canoe) safaris</li><li>Walking safaris with expert guides</li><li>Helicopter flights over the delta</li><li>Luxury tented camps</li></ul>',
                'regenerative_impact' => 'This journey supports community conservancies that protect the delta ecosystem while providing sustainable livelihoods for local communities.',
                'journey_category' => 'Luxury Retreats',
                'is_published' => true,
                'sort_order' => 3,
                'countries' => [],
            ],
        ];

        foreach ($journeys as $journeyData) {
            $countries = $journeyData['countries'] ?? [];
            unset($journeyData['countries']);

            $journey = Journey::firstOrCreate(
                ['slug' => $journeyData['slug']],
                $journeyData
            );

            if (!empty($countries)) {
                $journey->countries()->sync($countries);
            }
        }
    }
}
