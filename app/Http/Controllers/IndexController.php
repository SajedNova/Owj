<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\Achievement;
use App\Models\Brand;
use App\Models\HeroSection;
use App\Models\Portfolios;
use App\Models\Service;
use App\Models\TeamMembers;
use App\Models\SiteSetting;
use App\Models\Technology;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $hero = HeroSection::first();
        $about = AboutSection::first();
        $services = Service::orderBy('order')->get();
        $achievements = Achievement::orderBy('order')->get();
        $technologies = Technology::orderBy('order')->get();
        $brands = Brand::orderBy('order')->get();
        $portfolios = Portfolios::latest()->take(4)->get();
        $teamMembers = TeamMembers::all();
        $siteSetting = SiteSetting::first();
        return view('index', compact('hero', 'about', 'services', 'achievements', 'technologies', 'brands', 'portfolios', 'teamMembers', 'siteSetting'));
    }
}
