<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHeroSectionRequest;
use App\Models\HeroSection;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    public function edit()
    {
        $heroSection = HeroSection::findOrFail(1);
        return view('admin.hero-section.edit', compact('heroSection'));
    }

    public function update(UpdateHeroSectionRequest $request)
    {
        $heroSection = HeroSection::findOrFail(1);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($heroSection->image) {
                Storage::delete($heroSection->image);
            }
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $heroSection->update($data);

        return back()->with('success', 'تغییرات با موفقیت ذخیره شد.');
    }
}
