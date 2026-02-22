<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'company_name' => 'Halisi Africa Discoveries',
            'company_tagline' => 'Authentic African Journeys, Designed to Regenerate',
            'company_address' => 'PO Box 1234',
            'company_city' => 'Nairobi',
            'company_state' => '',
            'company_country' => 'Kenya',
            'company_postal_code' => '00100',
            'company_phone' => '+254 700 000 000',
            'office_hours' => 'Mon–Fri: 09:00 — 17:00',
            'company_email' => 'info@halisiafrica.com',
            'company_website' => 'https://halisiafrica.com',
            'social_facebook' => 'https://facebook.com/halisiafrica',
            'social_instagram' => 'https://instagram.com/halisiafrica',
            'social_twitter' => 'https://twitter.com/halisiafrica',
            'social_linkedin' => 'https://linkedin.com/company/halisiafrica',
            'social_youtube' => '',
            'social_pinterest' => '',
            'default_meta_title' => 'Halisi Africa Discoveries',
            'default_meta_description' => 'Authentic African Journeys, Designed to Regenerate.',
            'default_meta_keywords' => 'africa, travel, safari, luxury, conservation, regenerative tourism',
            'google_analytics_id' => '',
            'google_tag_manager_id' => '',
            'tinymce_api_key' => '',
            'newsletter_popup_enabled' => '0',
            'newsletter_popup_delay_seconds' => '10',
            'newsletter_popup_title' => 'Stay Connected with Halisi',
            'newsletter_popup_description' => 'Get travel inspiration, impact stories, and curated journey ideas.',
            'newsletter_popup_button_label' => 'Subscribe',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $key],
                [
                    'setting_type' => str_starts_with($key, 'social_') || str_ends_with($key, '_website') ? 'url' : 'text',
                    'setting_value' => $value,
                ]
            );
        }
    }
}
