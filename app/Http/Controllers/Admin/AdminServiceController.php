<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderByRaw("FIELD(package_type, 'basic', 'premium', 'platinum')")
            ->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_start' => 'required|numeric|min:0',
            'price_end' => 'nullable|numeric|min:0|gte:price_start',
            'duration_hours' => 'required|integer|min:1',
            'features' => 'required|array',
            'features.*' => 'string|max:255',
            'package_type' => 'required|in:basic,premium,platinum',
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil ditambahkan.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_start' => 'required|numeric|min:0',
            'price_end' => 'nullable|numeric|min:0|gte:price_start',
            'duration_hours' => 'required|integer|min:1',
            'features' => 'required|array',
            'features.*' => 'string|max:255',
            'package_type' => 'required|in:basic,premium,platinum',
            'is_popular' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil diupdate.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service berhasil dihapus.');
    }
}
