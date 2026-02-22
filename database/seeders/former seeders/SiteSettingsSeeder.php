<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Company Information
            ['setting_key' => 'company_name', 'setting_type' => 'text', 'setting_value' => 'Halisi Africa Discoveries'],
            ['setting_key' => 'company_tagline', 'setting_type' => 'text', 'setting_value' => 'Authentic African Journeys, Designed to Regenerate'],
            ['setting_key' => 'company_address', 'setting_type' => 'text', 'setting_value' => ''],
            ['setting_key' => 'company_city', 'setting_type' => 'text', 'setting_value' => ''],
            ['setting_key' => 'company_state', 'setting_type' => 'text', 'setting_value' => ''],
            ['setting_key' => 'company_country', 'setting_type' => 'text', 'setting_value' => 'Kenya'],
            ['setting_key' => 'company_postal_code', 'setting_type' => 'text', 'setting_value' => ''],
            ['setting_key' => 'company_phone', 'setting_type' => 'text', 'setting_value' => ''],
            ['setting_key' => 'company_email', 'setting_type' => 'url', 'setting_value' => ''],
            ['setting_key' => 'company_website', 'setting_type' => 'url', 'setting_value' => 'https://www.halisiafrica.com'],

            // Logos & Branding placeholders
            ['setting_key' => 'logo_main', 'setting_type' => 'image', 'setting_value' => ''],
            ['setting_key' => 'logo_footer', 'setting_type' => 'image', 'setting_value' => ''],
            ['setting_key' => 'logo_icon', 'setting_type' => 'image', 'setting_value' => ''],
            ['setting_key' => 'favicon', 'setting_type' => 'image', 'setting_value' => ''],

            // Social Media
            ['setting_key' => 'social_facebook', 'setting_type' => 'url', 'setting_value' => ''],
            ['setting_key' => 'social_instagram', 'setting_type' => 'url', 'setting_value' => ''],
            ['setting_key' => 'social_twitter', 'setting_type' => 'url', 'setting_value' => ''],
            ['setting_key' => 'social_linkedin', 'setting_type' => 'url', 'setting_value' => ''],
            ['setting_key' => 'social_youtube', 'setting_type' => 'url', 'setting_value' => ''],
            ['setting_key' => 'social_pinterest', 'setting_type' => 'url', 'setting_value' => ''],

            // SEO Settings
            ['setting_key' => 'default_meta_title', 'setting_type' => 'text', 'setting_value' => 'Halisi Africa Discoveries | Authentic African Journeys'],
            ['setting_key' => 'default_meta_description', 'setting_type' => 'text', 'setting_value' => 'Luxury travel across Africa rooted in conservation and community. Discover bespoke safaris, retreats, and impact-led journeys.'],
            ['setting_key' => 'default_meta_keywords', 'setting_type' => 'text', 'setting_value' => 'africa, safari, luxury travel, conservation, community tourism'],
            ['setting_key' => 'google_analytics_id', 'setting_type' => 'text', 'setting_value' => ''],
            ['setting_key' => 'google_tag_manager_id', 'setting_type' => 'text', 'setting_value' => ''],
            ['setting_key' => 'tinymce_api_key', 'setting_type' => 'text', 'setting_value' => ''],
        ];

        foreach ($settings as $setting) {
            SiteSetting::firstOrCreate(
                ['setting_key' => $setting['setting_key']],
                $setting
            );
        }
    }
}
