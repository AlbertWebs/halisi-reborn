<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Str;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Halisi',
                'slug' => 'about-halisi',
                'hero_title' => 'About Halisi Africa Discoveries',
                'hero_subtext' => 'Authentic African Journeys, Designed to Regenerate',
                'body_content' => '<p>Halisi Africa Discoveries was founded on a simple but powerful belief: travel should regenerate, not just visit.</p><p>We craft authentic African journeys that go beyond the ordinary—experiences that connect travelers with the continent\'s incredible wildlife, diverse cultures, and breathtaking landscapes while actively contributing to conservation and community empowerment.</p>',
                'meta_title' => 'About Halisi Africa Discoveries - Regenerative Travel',
                'meta_description' => 'Learn about Halisi Africa Discoveries and our commitment to regenerative tourism across Africa.',
                'is_published' => true,
            ],
            [
                'title' => 'Work With Us',
                'slug' => 'work-with-us',
                'hero_title' => 'Work With Us',
                'hero_subtext' => 'Partnerships that create positive impact',
                'body_content' => '<p>We partner with lodges, guides, communities, and conservation organizations across Africa to create journeys that benefit everyone.</p>',
                'meta_title' => 'Work With Us - Halisi Africa Discoveries',
                'meta_description' => 'Partner with Halisi Africa Discoveries to create regenerative travel experiences.',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
