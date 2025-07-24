<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPortfolios = Portfolio::with('category')
            ->featured()
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('package_type')
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount('portfolios')
            ->get();

        return view('home.index', compact('featuredPortfolios', 'services', 'categories'));
    }
}
