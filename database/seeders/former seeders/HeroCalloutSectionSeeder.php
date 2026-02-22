<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HeroCalloutSectionSeeder extends Seeder
{
    public function run(): void
    {
        HomepageSection::updateOrCreate(
            ['section_key' => 'hero_callout'],
            [
                'title' => 'Where Eco is Luxury',
                'subtitle' => "Immerse yourself in our wild,\nprecious world",
                'content' => null,
                'cta_label' => null,
                'cta_link' => null,
                'sort_order' => 3,
                'is_active' => true,
            ]
        );
    }
}
