<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminPortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            // Store original image
            $imagePath = $image->storeAs('portfolios', $filename, 'public');

            // Create thumbnail
            $thumbnailPath = 'portfolios/thumbs/' . $filename;
            $thumbnail = Image::make($image)->fit(400, 300);
            Storage::disk('public')->put($thumbnailPath, $thumbnail->encode());

            $validated['image_path'] = $imagePath;
            $validated['thumbnail_path'] = $thumbnailPath;
        }

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil ditambahkan.');
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio->load('category');
        return view('admin.portfolios.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        if ($request->hasFile('image')) {
            // Delete old images
            if ($portfolio->image_path) {
                Storage::disk('public')->delete($portfolio->image_path);
            }
            if ($portfolio->thumbnail_path) {
                Storage::disk('public')->delete($portfolio->thumbnail_path);
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            // Store new image
            $imagePath = $image->storeAs('portfolios', $filename, 'public');

            // Create thumbnail
            $thumbnailPath = 'portfolios/thumbs/' . $filename;
            $thumbnail = Image::make($image)->fit(400, 300);
            Storage::disk('public')->put($thumbnailPath, $thumbnail->encode());

            $validated['image_path'] = $imagePath;
            $validated['thumbnail_path'] = $thumbnailPath;
        }

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil diupdate.');
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete images
        if ($portfolio->image_path) {
            Storage::disk('public')->delete($portfolio->image_path);
        }
        if ($portfolio->thumbnail_path) {
            Storage::disk('public')->delete($portfolio->thumbnail_path);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio berhasil dihapus.');
    }

    public function toggleFeatured(Portfolio $portfolio)
    {
        $portfolio->update(['is_featured' => !$portfolio->is_featured]);

        return response()->json([
            'success' => true,
            'is_featured' => $portfolio->is_featured
        ]);
    }
}
