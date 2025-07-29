<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page
     */
    public function index()
    {
        // Get featured work for the about page
        $featuredWork = Portfolio::where('is_featured', true)
            ->with('category')
            ->latest()
            ->take(6)
            ->get();

        // Get active services
        $services = Service::where('is_active', true)
            ->orderByRaw("FIELD(package_type, 'basic', 'premium', 'platinum')")
            ->take(3)
            ->get();

        // Statistics data
        $stats = [
            'years_experience' => 8,
            'happy_clients' => 250,
            'projects_completed' => 400,
            'awards_won' => 15
        ];

        return view('about.index', compact('featuredWork', 'services', 'stats'));
    }
}
