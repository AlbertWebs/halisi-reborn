<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            [
                'name' => 'Kenya',
                'slug' => 'kenya',
                'hero_subtitle' => 'From the Maasai Mara to pristine coastal sanctuaries, Kenya blends iconic wildlife with meaningful conservation impact.',
                'country_narrative' => '<p>Kenya is a land of dramatic contrasts, from the snow-capped slopes of Mount Kenya to the vast savannas of the Maasai Mara. Our journeys connect travelers with wildlife, culture, and local stewardship.</p><p>We work with trusted camps, guides, and community conservancies to ensure every itinerary contributes to both ecosystem protection and livelihoods.</p>',
                'signature_experiences' => '<p>Private game drives, walking safaris, cultural encounters, and tailored conservation visits designed around your pace and interests.</p>',
                'signature_experiences_title' => 'Signature Experiences',
                'signature_card_1_label' => 'Wildlife Encounters',
                'signature_card_2_label' => 'Cultural Immersion',
                'signature_card_3_label' => 'Adventure Activities',
                'signature_card_4_label' => 'Luxury Lodging',
                'conservation_focus' => '<p>Our Kenya portfolio supports anti-poaching initiatives, habitat restoration, and women-led community enterprises.</p>',
                'conservation_title' => 'Conservation & Community Focus',
                'conservation_visual_text' => '<p><strong>Conservation in action.</strong><br>Community-led impact across Kenya.</p>',
                'conservation_button_text' => 'Learn About Our Impact Approach',
                'conservation_button_link' => '/responsible-regenerative-travel',
                'featured_journeys_title' => 'Featured Journeys in Kenya',
                'featured_journeys_button_text' => 'View All Journeys',
                'cta_title' => 'Explore Kenya Journeys',
                'cta_description' => 'Let us design a bespoke journey in Kenya tailored to your interests and travel style.',
                'cta_button_text' => 'Design Your Journey',
                'cta_link' => '/contact?country=kenya',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Uganda',
                'slug' => 'uganda',
                'hero_subtitle' => 'The Pearl of Africa, where lush forests, gorillas, and vibrant cultures shape extraordinary journeys.',
                'country_narrative' => '<p>Uganda offers intimate encounters with mountain gorillas, rich biodiversity, and dynamic community stories. It is ideal for travelers seeking depth, wonder, and purpose.</p>',
                'signature_experiences' => '<p>Gorilla trekking, chimpanzee tracking, Nile experiences, and immersive community visits.</p>',
                'signature_experiences_title' => 'Signature Experiences',
                'conservation_focus' => '<p>Partnerships focus on forest conservation, community livelihoods, and biodiversity monitoring.</p>',
                'conservation_title' => 'Conservation & Community Focus',
                'cta_title' => 'Explore Uganda Journeys',
                'cta_description' => 'Discover a regenerative journey through Uganda’s forests and waterways.',
                'cta_button_text' => 'Design Your Journey',
                'cta_link' => '/contact?country=uganda',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Tanzania',
                'slug' => 'tanzania',
                'hero_subtitle' => 'From the Serengeti plains to Zanzibar shores, Tanzania delivers scale, beauty, and impact.',
                'country_narrative' => '<p>Tanzania brings together iconic migrations, rich cultural heritage, and meaningful conservation partnerships.</p>',
                'signature_experiences' => '<p>Great Migration safaris, crater explorations, marine escapes, and conservation-led encounters.</p>',
                'signature_experiences_title' => 'Signature Experiences',
                'conservation_focus' => '<p>Support for wildlife corridors, ranger programs, and climate-resilient community projects.</p>',
                'conservation_title' => 'Conservation & Community Focus',
                'cta_title' => 'Explore Tanzania Journeys',
                'cta_description' => 'Experience Tanzania through bespoke itineraries built around conservation and comfort.',
                'cta_button_text' => 'Design Your Journey',
                'cta_link' => '/contact?country=tanzania',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Zambia',
                'slug' => 'zambia',
                'hero_subtitle' => 'Untamed wilderness and authentic safari traditions in one of Africa’s most rewarding destinations.',
                'country_narrative' => '<p>Zambia is known for world-class walking safaris and low-density wildlife experiences that feel truly wild.</p>',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Zimbabwe',
                'slug' => 'zimbabwe',
                'hero_subtitle' => 'Timeless landscapes, powerful wildlife moments, and warm cultural hospitality.',
                'country_narrative' => '<p>Zimbabwe combines exceptional guiding, dramatic scenery, and conservation-centered travel.</p>',
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Botswana',
                'slug' => 'botswana',
                'hero_subtitle' => 'High-value, low-impact exploration in the Okavango Delta and beyond.',
                'country_narrative' => '<p>Botswana offers pristine wilderness, remarkable wildlife density, and standout conservation outcomes.</p>',
                'is_published' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Namibia',
                'slug' => 'namibia',
                'hero_subtitle' => 'Epic deserts, stark beauty, and resilient communities shaping conservation futures.',
                'country_narrative' => '<p>Namibia’s dramatic terrain and conservation model create a distinct travel experience rooted in regeneration.</p>',
                'is_published' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['slug' => $country['slug']],
                $country
            );
        }
    }
}
