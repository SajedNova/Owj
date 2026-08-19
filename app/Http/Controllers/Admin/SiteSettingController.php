<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingRequest;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::firstOrCreate(['id' => 1]);
        return view('admin.site-settings.edit', compact('setting'));
    }

    public function update(UpdateSiteSettingRequest $request)
    {
        $setting = SiteSetting::findOrFail(1);
        $setting->update($request->validated());

        return back()->with('success', 'اطلاعات سایت با موفقیت به‌روزرسانی شد.');
    }
}
