<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImpactStat;

class ImpactSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'stat_key' => 'mangroves_planted',
                'label' => 'Mangroves Planted',
                'value' => 50000,
                'suffix' => '+',
                'description' => 'Through our One Tourist = One Mangrove initiative',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'stat_key' => 'women_reached',
                'label' => 'Women Reached',
                'value' => 2500,
                'suffix' => '+',
                'description' => 'Through community empowerment programs',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'stat_key' => 'communities_supported',
                'label' => 'Communities Supported',
                'value' => 45,
                'suffix' => '+',
                'description' => 'Across 7 African countries',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            ImpactStat::firstOrCreate(
                ['stat_key' => $stat['stat_key']],
                $stat
            );
        }
    }
}
