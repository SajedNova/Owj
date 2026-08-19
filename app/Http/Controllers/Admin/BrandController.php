<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('order')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(StoreBrandRequest $request)
    {
        $data = $request->validated();
        $data['logo'] = $request->file('logo')->store('brands', 'public');

        Brand::create($data);

        return redirect()->route('brands.index')->with('success', 'برند با موفقیت اضافه شد.');
    }

    public function destroy(Brand $brand)
    {
        Storage::delete($brand->logo);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'برند با موفقیت حذف شد.');
    }
}
