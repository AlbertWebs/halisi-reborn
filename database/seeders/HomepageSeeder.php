<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageSection;

class HomepageSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'hero',
                'title' => 'Authentic African Journeys, Designed to Regenerate',
                'subtitle' => 'Luxury travel across Africa, rooted in conservation and community.',
                'content' => null,
                'cta_label' => 'Design Your Journey',
                'cta_link' => '/contact',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'section_key' => 'intro',
                'title' => null,
                'subtitle' => null,
                'content' => 'Halisi Africa Discoveries crafts authentic African journeys that go beyond travel—creating experiences that regenerate ecosystems, empower communities, and transform perspectives.',
                'cta_label' => null,
                'cta_link' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($sections as $section) {
            HomepageSection::firstOrCreate(
                ['section_key' => $section['section_key']],
                $section
            );
        }
    }
}
