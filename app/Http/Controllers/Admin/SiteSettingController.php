<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{


    public function edit()
    {
        $settings = SiteSetting::first() ?? SiteSetting::create(['tagline' => '']);
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'tagline'            => ['nullable','string','max:2000'],
            'weather_iframe_src' => ['nullable','string','max:1000'],
        ]);

        $settings = SiteSetting::first();

        if (!$settings) {
            $settings = SiteSetting::create([
                'tagline' => $data['tagline'] ?? '',
                'weather_iframe_src' => $data['weather_iframe_src'] ?? null,
            ]);
        } else {
            $settings->update($data);
        }

        return back()->with('success', 'Settings updated');
    }

}
