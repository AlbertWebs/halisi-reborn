<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $settings = FooterSetting::orderBy('sort_order')->get()->keyBy('setting_key');
        return view('admin.footer.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            FooterSetting::updateOrCreate(
                ['setting_key' => $key],
                ['setting_value' => $value, 'setting_type' => 'text']
            );
        }

        return redirect()->route('admin.footer.index')->with('success', 'Footer settings updated successfully.');
    }
}
