<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Str;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Kenya',
                'slug' => 'kenya',
                'country_narrative' => 'Kenya is a land of dramatic contrasts, from the snow-capped peaks of Mount Kenya to the vast savannas of the Maasai Mara. Home to the Great Migration, this country offers some of Africa\'s most iconic wildlife experiences.',
                'signature_experiences' => '<ul><li>Witness the Great Migration in the Maasai Mara</li><li>Explore the Amboseli National Park with Mount Kilimanjaro backdrop</li><li>Experience authentic Maasai culture</li><li>Discover the pristine beaches of the Kenyan coast</li></ul>',
                'conservation_focus' => 'Kenya is at the forefront of conservation efforts, with community-based initiatives protecting wildlife and empowering local communities.',
                'cta_label' => 'Explore Kenya Journeys',
                'cta_link' => '/contact?country=kenya',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Tanzania',
                'slug' => 'tanzania',
                'country_narrative' => 'Tanzania is home to the Serengeti, Ngorongoro Crater, and Mount Kilimanjaro. This vast country offers unparalleled safari experiences and pristine wilderness.',
                'signature_experiences' => '<ul><li>Serengeti National Park game drives</li><li>Ngorongoro Crater exploration</li><li>Mount Kilimanjaro trekking</li><li>Zanzibar island retreats</li></ul>',
                'conservation_focus' => 'Tanzania\'s conservation model integrates community development with wildlife protection, creating sustainable tourism ecosystems.',
                'cta_label' => 'Explore Tanzania Journeys',
                'cta_link' => '/contact?country=tanzania',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Uganda',
                'slug' => 'uganda',
                'country_narrative' => 'Uganda, the Pearl of Africa, offers intimate gorilla trekking experiences, diverse landscapes, and warm hospitality.',
                'signature_experiences' => '<ul><li>Mountain gorilla trekking in Bwindi</li><li>Chimpanzee tracking in Kibale Forest</li><li>Source of the Nile exploration</li><li>Queen Elizabeth National Park safaris</li></ul>',
                'conservation_focus' => 'Uganda\'s gorilla conservation programs directly benefit local communities while protecting these magnificent primates.',
                'cta_label' => 'Explore Uganda Journeys',
                'cta_link' => '/contact?country=uganda',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Zambia',
                'slug' => 'zambia',
                'country_narrative' => 'Zambia offers authentic, uncrowded safari experiences with walking safaris, river adventures, and incredible wildlife viewing.',
                'signature_experiences' => '<ul><li>Walking safaris in South Luangwa</li><li>Victoria Falls exploration</li><li>Zambezi River adventures</li><li>Remote wilderness camps</li></ul>',
                'conservation_focus' => 'Zambia\'s community conservancies protect wildlife corridors while providing sustainable livelihoods.',
                'cta_label' => 'Explore Zambia Journeys',
                'cta_link' => '/contact?country=zambia',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Zimbabwe',
                'slug' => 'zimbabwe',
                'country_narrative' => 'Zimbabwe combines world-class game viewing with the awe-inspiring Victoria Falls and rich cultural heritage.',
                'signature_experiences' => '<ul><li>Hwange National Park safaris</li><li>Victoria Falls experiences</li><li>Mana Pools National Park</li><li>Cultural village visits</li></ul>',
                'conservation_focus' => 'Zimbabwe\'s conservation efforts focus on anti-poaching and community empowerment programs.',
                'cta_label' => 'Explore Zimbabwe Journeys',
                'cta_link' => '/contact?country=zimbabwe',
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Botswana',
                'slug' => 'botswana',
                'country_narrative' => 'Botswana offers exclusive, low-impact safari experiences in pristine wilderness areas, from the Okavango Delta to the Kalahari.',
                'signature_experiences' => '<ul><li>Okavango Delta mokoro safaris</li><li>Chobe National Park game viewing</li><li>Kalahari Desert experiences</li><li>Luxury tented camps</li></ul>',
                'conservation_focus' => 'Botswana\'s high-value, low-impact tourism model protects ecosystems while generating conservation funding.',
                'cta_label' => 'Explore Botswana Journeys',
                'cta_link' => '/contact?country=botswana',
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Namibia',
                'slug' => 'namibia',
                'country_narrative' => 'Namibia\'s dramatic landscapes, from the Namib Desert to the Skeleton Coast, offer unique adventures and incredible photography opportunities.',
                'signature_experiences' => '<ul><li>Sossusvlei sand dunes</li><li>Etosha National Park</li><li>Skeleton Coast exploration</li><li>Desert-adapted wildlife viewing</li></ul>',
                'conservation_focus' => 'Namibia\'s community conservancy model has been internationally recognized for its success in wildlife conservation.',
                'cta_label' => 'Explore Namibia Journeys',
                'cta_link' => '/contact?country=namibia',
                'is_published' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(
                ['slug' => $country['slug']],
                $country
            );
        }
    }
}
