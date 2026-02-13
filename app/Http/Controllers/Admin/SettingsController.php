<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->keyBy('setting_key');
        // Ensure we always have an array with keys to avoid errors
        $defaultSettings = [
            'company_name' => new SiteSetting(['setting_key' => 'company_name', 'setting_value' => 'Halisi Africa Discoveries']),
            'company_tagline' => new SiteSetting(['setting_key' => 'company_tagline', 'setting_value' => 'Authentic African Journeys, Designed to Regenerate']),
        ];
        foreach ($defaultSettings as $key => $default) {
            if (!isset($settings[$key])) {
                $settings[$key] = $default;
            }
        }
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            // Company Information
            'company_name' => 'nullable|string|max:255',
            'company_tagline' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_city' => 'nullable|string|max:255',
            'company_state' => 'nullable|string|max:255',
            'company_country' => 'nullable|string|max:255',
            'company_postal_code' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_website' => 'nullable|url|max:255',
            
            // Logos & Images
            'logo_main' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'logo_footer' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'logo_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:512',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,gif,svg|max:512',
            
            // Social Media
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_pinterest' => 'nullable|url|max:255',
            
            // SEO Settings
            'default_meta_title' => 'nullable|string|max:255',
            'default_meta_description' => 'nullable|string|max:500',
            'default_meta_keywords' => 'nullable|string|max:500',
            'google_analytics_id' => 'nullable|string|max:255',
            'google_tag_manager_id' => 'nullable|string|max:255',
            'tinymce_api_key' => 'nullable|string|max:255',
        ]);

        // Handle file uploads
        $fileFields = ['logo_main', 'logo_footer', 'logo_icon', 'favicon'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('settings', 'public');
                
                // Delete old file if exists
                $oldSetting = SiteSetting::where('setting_key', $field)->first();
                if ($oldSetting && $oldSetting->setting_value) {
                    Storage::disk('public')->delete($oldSetting->setting_value);
                }
                
                SiteSetting::set($field, $path, 'image');
            } elseif ($request->input($field . '_remove') == '1') {
                // Handle removal
                $oldSetting = SiteSetting::where('setting_key', $field)->first();
                if ($oldSetting && $oldSetting->setting_value) {
                    Storage::disk('public')->delete($oldSetting->setting_value);
                }
                SiteSetting::where('setting_key', $field)->delete();
            }
        }

        // Save text/URL fields
        $textFields = [
            'company_name', 'company_tagline', 'company_address', 'company_city',
            'company_state', 'company_country', 'company_postal_code',
            'company_phone', 'company_email', 'company_website',
            'social_facebook', 'social_instagram', 'social_twitter',
            'social_linkedin', 'social_youtube', 'social_pinterest',
            'default_meta_title', 'default_meta_description', 'default_meta_keywords',
            'google_analytics_id', 'google_tag_manager_id', 'tinymce_api_key'
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                $type = in_array($field, ['company_email', 'company_website', 'social_facebook', 'social_instagram', 'social_twitter', 'social_linkedin', 'social_youtube', 'social_pinterest']) ? 'url' : 'text';
                if (strpos($field, 'social_') === 0) {
                    $type = 'url';
                }
                SiteSetting::set($field, $request->input($field), $type);
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
