<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAboutSectionRequest;
use App\Models\AboutSection;
use App\Models\TeamMembers;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    public function edit()
    {
        $aboutSection = AboutSection::findOrFail(1);
        $userCount = TeamMembers::all()->count();
        return view('admin.about-section.edit', compact('aboutSection', 'userCount'));
    }

    public function update(UpdateAboutSectionRequest $request)
    {
        $aboutSection = AboutSection::findOrFail(1);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($aboutSection->image) {
                Storage::delete($aboutSection->image);
            }
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        $aboutSection->update($data);

        return back()->with('success', 'تغییرات با موفقیت ذخیره شد.');
    }
}
