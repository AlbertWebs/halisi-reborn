<?php

namespace Database\Seeders;

use App\Models\Journey;
use Illuminate\Database\Seeder;

class JourneysSeeder extends Seeder
{
    public function run(): void
    {
        $journeys = [
            [
                'title' => 'Kenya Signature Safari',
                'slug' => 'kenya-signature-safari',
                'narrative_intro' => 'An immersive wildlife journey across Kenya’s most celebrated ecosystems with conservation at the core.',
                'experience_highlights' => '<ul><li>Private game drives</li><li>Conservancy visits</li><li>Community-led storytelling</li></ul>',
                'regenerative_impact' => '<p>Supports local conservation teams and women-led livelihoods.</p>',
                'journey_category' => 'signature-safaris',
                'cta_label' => 'Enquire',
                'cta_link' => '/contact?journey=kenya-signature-safari',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Uganda Gorilla & Forest Journey',
                'slug' => 'uganda-gorilla-forest-journey',
                'narrative_intro' => 'Track gorillas responsibly and explore Uganda’s rich biodiversity through expert-led experiences.',
                'experience_highlights' => '<ul><li>Gorilla trekking</li><li>Chimpanzee tracking</li><li>Forest lodge stays</li></ul>',
                'regenerative_impact' => '<p>Contributes to forest protection and community conservation projects.</p>',
                'journey_category' => 'conservation-community',
                'cta_label' => 'Enquire',
                'cta_link' => '/contact?journey=uganda-gorilla-forest-journey',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Tanzania Migration Expedition',
                'slug' => 'tanzania-migration-expedition',
                'narrative_intro' => 'Follow the migration with expert guides while engaging with conservation partnerships on the ground.',
                'journey_category' => 'signature-safaris',
                'cta_label' => 'Enquire',
                'cta_link' => '/contact?journey=tanzania-migration-expedition',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Botswana Delta Luxury Retreat',
                'slug' => 'botswana-delta-luxury-retreat',
                'narrative_intro' => 'A refined Okavango journey blending high-comfort camps with low-impact exploration.',
                'journey_category' => 'luxury-retreats',
                'cta_label' => 'Enquire',
                'cta_link' => '/contact?journey=botswana-delta-luxury-retreat',
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Namibia Desert & Coast Escape',
                'slug' => 'namibia-desert-coast-escape',
                'narrative_intro' => 'Experience Namibia’s extraordinary dunes, coastline, and conservation-led lodges.',
                'journey_category' => 'bespoke-private-travel',
                'cta_label' => 'Enquire',
                'cta_link' => '/contact?journey=namibia-desert-coast-escape',
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Zimbabwe & Zambia River Adventure',
                'slug' => 'zimbabwe-zambia-river-adventure',
                'narrative_intro' => 'A cross-border journey combining river safaris, community partnerships, and iconic landscapes.',
                'journey_category' => 'conservation-community',
                'cta_label' => 'Enquire',
                'cta_link' => '/contact?journey=zimbabwe-zambia-river-adventure',
                'is_published' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($journeys as $journey) {
            Journey::updateOrCreate(
                ['slug' => $journey['slug']],
                $journey
            );
        }
    }
}
