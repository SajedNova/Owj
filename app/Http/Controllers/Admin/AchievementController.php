<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAchievementRequest;
use App\Models\Achievement;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::orderBy('order')->get();
        return view('admin.achievements.index', compact('achievements'));
    }

    public function create()
    {
        return view('admin.achievements.create');
    }

    public function store(StoreAchievementRequest $request)
    {
        Achievement::create($request->validated());
        return redirect()->route('achievements.index')->with('success', 'دستاورد با موفقیت اضافه شد.');
    }

    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return redirect()->route('achievements.index')->with('success', 'دستاورد با موفقیت حذف شد.');
    }
}
