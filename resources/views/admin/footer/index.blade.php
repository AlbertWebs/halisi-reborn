@extends('admin.layouts.admin')

@section('title', 'Footer Settings')
@section('page-title', 'Footer Settings')

@section('content')
    <form method="POST" action="{{ route('admin.footer.update') }}" class="space-y-6">
        @csrf
        @method('POST')

        <div class="bg-white rounded-lg shadow-sm p-6 space-y-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Social Links</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-2">Facebook URL</label>
                    <input type="url" id="facebook_url" name="facebook_url" value="{{ isset($settings['facebook_url']) ? $settings['facebook_url']->setting_value : '' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                    <input type="url" id="instagram_url" name="instagram_url" value="{{ isset($settings['instagram_url']) ? $settings['instagram_url']->setting_value : '' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-2">Twitter URL</label>
                    <input type="url" id="twitter_url" name="twitter_url" value="{{ isset($settings['twitter_url']) ? $settings['twitter_url']->setting_value : '' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>

                <div>
                    <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn URL</label>
                    <input type="url" id="linkedin_url" name="linkedin_url" value="{{ isset($settings['linkedin_url']) ? $settings['linkedin_url']->setting_value : '' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>
            </div>

            <div class="pt-6 border-t border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Footer Text</h3>
                <div>
                    <label for="copyright_text" class="block text-sm font-medium text-gray-700 mb-2">Copyright Text</label>
                    <input type="text" id="copyright_text" name="copyright_text" value="{{ isset($settings['copyright_text']) ? $settings['copyright_text']->setting_value : '© ' . date('Y') . ' Halisi Africa Discoveries. All rights reserved.' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-lg hover:bg-opacity-90 transition-colors font-medium">
                Update Footer Settings
            </button>
        </div>
    </form>
@endsection
