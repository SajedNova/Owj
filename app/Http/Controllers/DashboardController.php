<?php

namespace App\Http\Controllers;

use App\Models\Portfolios;
use App\Models\TeamMembers;
use App\Models\PortfolioImages;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalPortfolios' => Portfolios::count(),
            'publishedPortfolios' => Portfolios::where('is_published', true)->count(),
            'totalTeamMembers' => TeamMembers::count(),
            'totalImages' => PortfolioImages::count(),
        ];

        $recentPortfolios = Portfolios::with('mainImage')
            ->latest()
            ->limit(4)
            ->get();

        $recentTeamMembers = TeamMembers::latest()
            ->limit(4)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPortfolios', 'recentTeamMembers'));
    }
}
