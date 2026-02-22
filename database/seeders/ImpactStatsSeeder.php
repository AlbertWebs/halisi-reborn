<?php

namespace Database\Seeders;

use App\Models\ImpactStat;
use Illuminate\Database\Seeder;

class ImpactStatsSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['stat_key' => 'mangroves_planted', 'label' => 'Mangroves Planted', 'value' => 15000, 'suffix' => '+', 'description' => 'Mangrove seedlings planted through community-led restoration.', 'icon' => 'leaf', 'sort_order' => 1, 'is_active' => true],
            ['stat_key' => 'women_supported', 'label' => 'Women Supported', 'value' => 420, 'suffix' => '+', 'description' => 'Women participating in conservation and restoration programs.', 'icon' => 'users', 'sort_order' => 2, 'is_active' => true],
            ['stat_key' => 'carbon_offset_tons', 'label' => 'CO2 Offset (tons)', 'value' => 1800, 'suffix' => '+', 'description' => 'Estimated tons of CO2 offset through verified projects.', 'icon' => 'cloud', 'sort_order' => 3, 'is_active' => true],
            ['stat_key' => 'community_projects', 'label' => 'Community Projects', 'value' => 37, 'suffix' => '', 'description' => 'Active local community projects supported by Halisi journeys.', 'icon' => 'globe', 'sort_order' => 4, 'is_active' => true],
            ['stat_key' => 'countries_active', 'label' => 'Countries Active', 'value' => 7, 'suffix' => '', 'description' => 'African destinations with active regenerative travel programs.', 'icon' => 'map', 'sort_order' => 5, 'is_active' => true],
        ];

        foreach ($stats as $stat) {
            ImpactStat::updateOrCreate(
                ['stat_key' => $stat['stat_key']],
                $stat
            );
        }
    }
}
