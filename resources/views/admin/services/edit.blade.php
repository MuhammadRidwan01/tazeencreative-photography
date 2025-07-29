@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Service</h1>
                    <p class="text-gray-600 mt-1">Update {{ $service->name }}</p>
                </div>
                <a href="{{ route('admin.services.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Services
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="p-8 space-y-8">
                    <!-- Basic Information -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Basic Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Service Name</label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name', $service->name) }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                       placeholder="e.g., Wedding Photography Premium"
                                       required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="package_type" class="block text-sm font-medium text-gray-700 mb-2">Package Type</label>
                                <select id="package_type"
                                        name="package_type"
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('package_type') border-red-500 @enderror"
                                        required>
                                    <option value="">Select Package Type</option>
                                    <option value="basic" {{ old('package_type', $service->package_type) === 'basic' ? 'selected' : '' }}>Basic</option>
                                    <option value="premium" {{ old('package_type', $service->package_type) === 'premium' ? 'selected' : '' }}>Premium</option>
                                    <option value="luxury" {{ old('package_type', $service->package_type) === 'luxury' ? 'selected' : '' }}>Luxury</option>
                                </select>
                                @error('package_type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="duration_hours" class="block text-sm font-medium text-gray-700 mb-2">Duration (Hours)</label>
                                <input type="number"
                                       id="duration_hours"
                                       name="duration_hours"
                                       value="{{ old('duration_hours', $service->duration_hours) }}"
                                       min="1"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('duration_hours') border-red-500 @enderror"
                                       placeholder="8"
                                       required>
                                @error('duration_hours')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea id="description"
                                          name="description"
                                          rows="4"
                                          class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                                          placeholder="Describe the service package..."
                                          required>{{ old('description', $service->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Service Image</h2>
                        <div>
                            @if($service->image_url)
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Current Image</p>
                                    <img src="{{ $service->image_url }}" alt="Current service image" class="w-32 h-32 object-cover rounded-lg border">
                                </div>
                            @endif

                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload New Image</label>
                            <input type="file"
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('image') border-red-500 @enderror"
                                   onchange="previewImage(this)">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB. Leave empty to keep current image.</p>

                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <p class="text-sm font-medium text-gray-700 mb-2">New Image Preview</p>
                                <img id="preview" src="/placeholder.svg" alt="Preview" class="w-32 h-32 object-cover rounded-lg border">
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Pricing</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price_start" class="block text-sm font-medium text-gray-700 mb-2">Starting Price (Rp)</label>
                                <input type="number"
                                       id="price_start"
                                       name="price_start"
                                       value="{{ old('price_start', $service->price_start) }}"
                                       min="0"
                                       step="0.01"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price_start') border-red-500 @enderror"
                                       placeholder="5000000"
                                       required>
                                @error('price_start')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price_end" class="block text-sm font-medium text-gray-700 mb-2">End Price (Rp) <span class="text-gray-500">(Optional)</span></label>
                                <input type="number"
                                       id="price_end"
                                       name="price_end"
                                       value="{{ old('price_end', $service->price_end) }}"
                                       min="0"
                                       step="0.01"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('price_end') border-red-500 @enderror"
                                       placeholder="8000000">
                                @error('price_end')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Features -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Features</h2>
                        <div id="features-container">
                            @php
                                $features = old('features', $service->features ?? []);
                            @endphp
                            @foreach($features as $index => $feature)
                                <div class="feature-item flex items-center space-x-3 mb-3">
                                    <input type="text"
                                           name="features[]"
                                           value="{{ $feature }}"
                                           class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                           placeholder="e.g., Pre-wedding photoshoot included"
                                           required>
                                    <button type="button" onclick="removeFeature(this)" class="text-red-500 hover:text-red-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button"
                                onclick="addFeature()"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Feature
                        </button>
                        @error('features')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Settings -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Settings</h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox"
                                       id="is_popular"
                                       name="is_popular"
                                       value="1"
                                       {{ old('is_popular', $service->is_popular) ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="is_popular" class="ml-2 text-sm font-medium text-gray-700">Mark as Popular</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox"
                                       id="is_active"
                                       name="is_active"
                                       value="1"
                                       {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
                    <a href="{{ route('admin.services.index') }}"
                       class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-colors">
                        Update Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function addFeature() {
    const container = document.getElementById('features-container');
    const featureItem = document.createElement('div');
    featureItem.className = 'feature-item flex items-center space-x-3 mb-3';
    featureItem.innerHTML = `
        <input type="text"
               name="features[]"
               class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
               placeholder="e.g., Professional editing included"
               required>
        <button type="button" onclick="removeFeature(this)" class="text-red-500 hover:text-red-700">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    container.appendChild(featureItem);
}

function removeFeature(button) {
    const container = document.getElementById('features-container');
    if (container.children.length > 1) {
        button.parentElement.remove();
    }
}
</script>
@endsection
