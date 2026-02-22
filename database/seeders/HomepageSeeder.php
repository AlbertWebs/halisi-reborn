<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['section_key' => 'hero', 'title' => 'Authentic African Journeys, Designed to Regenerate', 'subtitle' => 'Luxury travel across Africa, rooted in conservation and community.', 'content' => null, 'cta_label' => 'Design Your Journey', 'cta_link' => '/contact', 'sort_order' => 1, 'is_active' => true],
            ['section_key' => 'intro', 'title' => null, 'subtitle' => 'Welcome To', 'content' => 'Halisi Africa Discoveries crafts authentic African journeys that go beyond travel and create regenerative impact for ecosystems and communities.', 'cta_label' => null, 'cta_link' => null, 'sort_order' => 2, 'is_active' => true],
            ['section_key' => 'hero_callout', 'title' => 'Where Eco is Luxury', 'subtitle' => "Immerse yourself in our wild,\nprecious world", 'content' => null, 'cta_label' => null, 'cta_link' => null, 'sort_order' => 3, 'is_active' => true],
            ['section_key' => 'experience_safaris', 'title' => 'Bespoke Safaris', 'subtitle' => null, 'content' => null, 'cta_label' => 'View Safaris', 'cta_link' => '/journeys/signature-safaris', 'sort_order' => 4, 'is_active' => true],
            ['section_key' => 'experience_luxury', 'title' => 'Luxury Escapes', 'subtitle' => null, 'content' => null, 'cta_label' => 'View Escapes', 'cta_link' => '/journeys/luxury-retreats', 'sort_order' => 5, 'is_active' => true],
            ['section_key' => 'experience_community', 'title' => 'Conservation & Community', 'subtitle' => null, 'content' => null, 'cta_label' => 'View Impact Journeys', 'cta_link' => '/journeys/conservation-community', 'sort_order' => 6, 'is_active' => true],
            ['section_key' => 'pillar_culture', 'title' => 'Culture', 'subtitle' => null, 'content' => 'Honoring and supporting traditional knowledge and cultural heritage.', 'cta_label' => 'Learn More', 'cta_link' => '/impact/responsible-travel', 'sort_order' => 10, 'is_active' => true],
            ['section_key' => 'pillar_community', 'title' => 'Community', 'subtitle' => null, 'content' => 'Investing in local leadership and sustainable livelihoods that benefit communities.', 'cta_label' => 'Learn More', 'cta_link' => '/impact/climate-community', 'sort_order' => 11, 'is_active' => true],
            ['section_key' => 'pillar_conservation', 'title' => 'Conservation', 'subtitle' => null, 'content' => 'Supporting projects that restore degraded landscapes and protect biodiversity.', 'cta_label' => 'Learn More', 'cta_link' => '/impact/responsible-travel', 'sort_order' => 12, 'is_active' => true],
            ['section_key' => 'pillar_change_agents', 'title' => 'Change Agents', 'subtitle' => null, 'content' => 'Empowering local leaders and initiatives that drive positive transformation.', 'cta_label' => 'Learn More', 'cta_link' => '/halisi-trust', 'sort_order' => 13, 'is_active' => true],
            ['section_key' => 'pillar_climate_action', 'title' => 'Climate Action', 'subtitle' => null, 'content' => 'Carbon-neutral journeys and support for climate resilience initiatives.', 'cta_label' => 'Learn More', 'cta_link' => '/climate-community-impact', 'sort_order' => 14, 'is_active' => true],
            ['section_key' => 'responsible_travel_teaser', 'title' => 'Responsible Travel & Carbon Offsetting', 'subtitle' => null, 'content' => 'Our commitment to climate-positive travel. Every journey with Halisi Africa is designed to leave a positive footprint.', 'cta_label' => 'Learn More', 'cta_link' => '/responsible-regenerative-travel', 'sort_order' => 20, 'is_active' => true],
            ['section_key' => 'women_restoration_teaser', 'title' => 'Women & Restoration Projects', 'subtitle' => null, 'content' => '<strong>Mangrove Restoration & Seedball Safaris.</strong> Through the Halisi Trust, we support women-led restoration projects across Africa.', 'cta_label' => 'Discover More', 'cta_link' => '/halisi-trust', 'sort_order' => 21, 'is_active' => true],
        ];

        foreach ($sections as $section) {
            HomepageSection::updateOrCreate(
                ['section_key' => $section['section_key']],
                $section
            );
        }
    }
}
