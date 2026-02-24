<?php

namespace Database\Seeders;

use App\Models\JourneyCategory;
use App\Models\Journey;
use Illuminate\Database\Seeder;

class JourneyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Signature Safaris', 'slug' => 'signature-safaris', 'sort_order' => 1],
            ['name' => 'Bespoke Private Travel', 'slug' => 'bespoke-private-travel', 'sort_order' => 2],
            ['name' => 'Conservation & Community', 'slug' => 'conservation-community', 'sort_order' => 3],
            ['name' => 'Luxury Retreats', 'slug' => 'luxury-retreats', 'sort_order' => 4],
        ];

        foreach ($categories as $item) {
            JourneyCategory::updateOrCreate(
                ['slug' => $item['slug']],
                ['name' => $item['name'], 'sort_order' => $item['sort_order']]
            );
        }

        // Link existing journeys to categories by matching journey_category (string) to category name
        foreach (JourneyCategory::all() as $category) {
            Journey::where('journey_category', $category->name)->update(['journey_category_id' => $category->id]);
        }
    }
}
