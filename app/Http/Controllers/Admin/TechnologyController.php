<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Models\Technology;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologies = Technology::orderBy('order')->get();
        return view('admin.technologies.index', compact('technologies'));
    }

    public function create()
    {
        return view('admin.technologies.create');
    }

    public function store(StoreTechnologyRequest $request)
    {
        Technology::create($request->validated());
        return redirect()->route('technologies.index')->with('success', 'تکنولوژی با موفقیت اضافه شد.');
    }

    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('technologies.index')->with('success', 'تکنولوژی با موفقیت حذف شد.');
    }
}
