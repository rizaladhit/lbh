<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\JenisPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppSettingController extends Controller
{
    public function edit()
    {
        $setting = AppSetting::getSettings();
        $jenisPelayanans = JenisPelayanan::orderBy('nama')->get();
        return view('settings.edit', compact('setting', 'jenisPelayanans'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:50',
        ]);

        $setting = AppSetting::getSettings();
        $setting->app_name = $request->app_name;
        $setting->description = $request->description;
        $setting->address = $request->address;
        $setting->phone = $request->phone;

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $setting->logo_path = $request->file('logo')->store('logos', 'public');
        }

        if ($request->boolean('remove_logo') && $setting->logo_path) {
            Storage::disk('public')->delete($setting->logo_path);
            $setting->logo_path = null;
        }

        $setting->save();

        return redirect()->route('settings.edit')->with('success', 'Pengaturan aplikasi berhasil disimpan.');
    }
}
