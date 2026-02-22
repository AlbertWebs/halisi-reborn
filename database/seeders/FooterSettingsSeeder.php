<?php

namespace Database\Seeders;

use App\Models\FooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['setting_key' => 'facebook_url', 'setting_type' => 'url', 'setting_value' => 'https://facebook.com/halisiafrica', 'sort_order' => 1],
            ['setting_key' => 'instagram_url', 'setting_type' => 'url', 'setting_value' => 'https://instagram.com/halisiafrica', 'sort_order' => 2],
            ['setting_key' => 'twitter_url', 'setting_type' => 'url', 'setting_value' => 'https://twitter.com/halisiafrica', 'sort_order' => 3],
            ['setting_key' => 'linkedin_url', 'setting_type' => 'url', 'setting_value' => 'https://linkedin.com/company/halisiafrica', 'sort_order' => 4],
            ['setting_key' => 'copyright_text', 'setting_type' => 'text', 'setting_value' => '© ' . date('Y') . ' Halisi Africa Discoveries. All rights reserved.', 'sort_order' => 10],
        ];

        foreach ($settings as $setting) {
            FooterSetting::updateOrCreate(
                ['setting_key' => $setting['setting_key']],
                $setting
            );
        }
    }
}
