<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_start' => 'required|numeric|min:0',
            'price_end' => 'nullable|numeric|min:0|gte:price_start',
            'duration_hours' => 'required|integer|min:1',
            'package_type' => 'required|in:basic,premium,luxury',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_popular'] = $request->has('is_popular');
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('services', $imageName, 'public');
            $data['image_url'] = $imagePath;
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil ditambahkan!');
    }

    public function show(Service $service)
    {
        // Load relationships and get recent bookings
        $service->load('bookings.user');
        $recentBookings = $service->bookings()->with('user')->latest()->take(5)->get();
        $bookingsCount = $service->bookings()->count();

        return view('admin.services.show', compact('service', 'recentBookings', 'bookingsCount'));
    }

    public function edit(Service $service)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        // Handle AJAX requests for status updates
        if ($request->expectsJson()) {
            $validated = $request->validate([
                'is_active' => 'sometimes|boolean',
                'is_popular' => 'sometimes|boolean'
            ]);

            $service->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Service updated successfully'
            ]);
        }

        // Handle regular form updates
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_start' => 'required|numeric|min:0',
            'price_end' => 'nullable|numeric|min:0|gte:price_start',
            'duration_hours' => 'required|integer|min:1',
            'package_type' => 'required|in:basic,premium,luxury',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_popular'] = $request->has('is_popular');
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image_url && Storage::disk('public')->exists($service->image_url)) {
                Storage::disk('public')->delete($service->image_url);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('services', $imageName, 'public');
            $data['image_url'] = $imagePath;
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil diupdate!');
    }

    public function destroy(Service $service)
    {
        // Delete image if exists
        if ($service->image_url && Storage::disk('public')->exists($service->image_url)) {
            Storage::disk('public')->delete($service->image_url);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil dihapus!');
    }

    public function toggleActive(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $service->is_active,
            'message' => 'Status berhasil diubah!'
        ]);
    }

    public function togglePopular(Service $service)
    {
        $service->update(['is_popular' => !$service->is_popular]);

        return response()->json([
            'success' => true,
            'is_popular' => $service->is_popular,
            'message' => 'Status popular berhasil diubah!'
        ]);
    }
}
