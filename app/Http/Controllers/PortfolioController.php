<?php

namespace App\Http\Controllers;

use App\Models\Portfolios;
use App\Models\TeamMembers;
use App\Http\Requests\StorePortfolioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Public listing page — all published portfolios.
     */
    public function publicIndex()
    {
        $portfolios = Portfolios::where('is_published', true)
            ->with('images')
            ->latest()
            ->get();

        return view('portfolio-list', compact('portfolios'));
    }

    /**
     * Public detail page for a single portfolio, resolved by slug.
     */
    public function show(Portfolios $portfolio)
    {
        if (!$portfolio->is_published) {
            abort(404);
        }

        $portfolio->load(['images', 'teamMembers']);

        $similar = Portfolios::where('is_published', true)
            ->where('category', $portfolio->category)
            ->where('id', '!=', $portfolio->id)
            ->with('images')
            ->limit(3)
            ->get();

        return view('portfolio-detail', compact('portfolio', 'similar'));
    }

    public function index()
    {
        $portfolios = Portfolios::with(['images', 'teamMembers'])->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $teamMembers = TeamMembers::all();
        return view('admin.portfolio.create', compact('teamMembers'));
    }

    public function store(StorePortfolioRequest $request)
    {
        $portfolio = Portfolios::create($request->validated());

        if ($request->has('team')) {
            $portfolio->teamMembers()->sync($request->team);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('portfolios', 'public');
                $isMain = ($index == $request->main_image_index);
                $portfolio->images()->create(['url' => $path, 'is_main' => $isMain]);
            }
        }

        return redirect()->route('portfolios.index')->with('success', 'نمونه کار با موفقیت ایجاد شد.');
    }

    public function edit(Portfolios $portfolio)
    {
        $teamMembers = TeamMembers::all();
        $portfolio->load(['images', 'teamMembers']);
        return view('admin.portfolio.edit', compact('portfolio', 'teamMembers'));
    }

    public function update(StorePortfolioRequest $request, Portfolios $portfolio)
    {
        $portfolio->update($request->validated());

        $portfolio->teamMembers()->sync($request->team ?? []);

        // Logic for updating images (simple: remove old, add new) - can be improved later
        if ($request->hasFile('images')) {
            foreach ($portfolio->images as $image) {
                Storage::disk('public')->delete($image->url);
                $image->delete();
            }
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('portfolios', 'public');
                $isMain = ($index == $request->main_image_index);
                $portfolio->images()->create(['url' => $path, 'is_main' => $isMain]);
            }
        }

        return redirect()->route('portfolios.index')->with('success', 'نمونه کار با موفقیت ویرایش شد.');
    }

    public function destroy(Portfolios $portfolio)
    {
        foreach ($portfolio->images as $image) {
            Storage::disk('public')->delete($image->url);
        }
        $portfolio->delete();
        return redirect()->route('portfolios.index')->with('success', 'نمونه کار با موفقیت حذف شد.');
    }

    public function togglePublish(Portfolios $portfolio)
    {
        $portfolio->update(['is_published' => !$portfolio->is_published]);
        return back()->with('success', 'وضعیت انتشار با موفقیت تغییر کرد.');
    }


}

