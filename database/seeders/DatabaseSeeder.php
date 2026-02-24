<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingsSeeder::class,
            FooterSettingsSeeder::class,
            HomepageSeeder::class,
            PagesSeeder::class,
            ImpactStatsSeeder::class,
            JourneyCategorySeeder::class,
            CountriesSeeder::class,
            JourneysSeeder::class,
            CountryJourneySeeder::class,
            TrustPostsSeeder::class,
        ]);
    }
}
