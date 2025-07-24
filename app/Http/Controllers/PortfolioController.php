<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->withCount('portfolios')
            ->get();

        $query = Portfolio::with('category');

        if ($request->has('category') && $request->category !== 'all') {
            $query->byCategory($request->category);
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $portfolios = $query->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('portfolio.index', compact('portfolios', 'categories'));
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio->load('category');

        $relatedPortfolios = Portfolio::where('category_id', $portfolio->category_id)
            ->where('id', '!=', $portfolio->id)
            ->take(4)
            ->get();

        return view('portfolio.show', compact('portfolio', 'relatedPortfolios'));
    }
}
