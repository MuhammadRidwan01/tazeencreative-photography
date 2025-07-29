@extends('layouts.app')

@section('title', $service->name)
@section('description', $service->description)

@section('content')
<!-- Service Detail -->
<section class="section-padding">
    <div class="container-custom">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-400 hover:text-gray-500">
                        <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('services.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Services</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-4 text-sm font-medium text-gray-500">{{ $service->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Service Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Header -->
                <div>
                    <div class="flex items-center space-x-4 mb-4">
                        <h1 class="text-4xl md:text-5xl font-serif font-bold text-gray-900">{{ $service->name }}</h1>
                        @if($service->is_popular)
                            <span class="bg-gold-500 text-black text-sm font-bold px-3 py-1 rounded-full">
                                POPULAR
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center space-x-6 text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $service->duration_hours }} hours session
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ ucfirst($service->package_type) }} Package
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-900 mb-4">About This Package</h2>
                    <div class="prose prose-lg text-gray-600">
                        <p>{{ $service->description }}</p>
                    </div>
                </div>

                <!-- Features -->
                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6">What's Included</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($service->features as $feature)
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sample Gallery -->
                <div>
                    <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6">Sample Work</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @for($i = 1; $i <= 6; $i++)
                            <div class="aspect-w-4 aspect-h-3 group cursor-pointer">
                                <img src="/placeholder.svg?height=300&width=400"
                                     alt="Sample work {{ $i }}"
                                     class="w-full h-48 object-cover rounded-lg shadow-md transition-transform duration-300 group-hover:scale-105"
                                     onclick="openLightbox('/placeholder.svg?height=600&width=800')">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Booking Card -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden">
                        <!-- Price Header -->
                        <div class="p-6 {{ $service->package_type === 'basic' ? 'bg-gray-50' : ($service->package_type === 'premium' ? 'bg-blue-50' : 'bg-gold-50') }}">
                            <div class="text-center">
                                <div class="text-4xl font-bold {{ $service->package_type === 'basic' ? 'text-gray-900' : ($service->package_type === 'premium' ? 'text-blue-600' : 'text-gold-600') }} mb-2">
                                    {{ $service->formatted_price }}
                                </div>
                                <p class="text-gray-600">{{ $service->package_type }} package</p>
                            </div>
                        </div>

                        <!-- Booking Form -->
                        <div class="p-6">
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Duration:</span>
                                    <span class="font-medium">{{ $service->duration_hours }} hours</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Package Type:</span>
                                    <span class="font-medium">{{ ucfirst($service->package_type) }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Features:</span>
                                    <span class="font-medium">{{ count($service->features) }} included</span>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <a href="{{ route('booking.create', ['service' => $service->slug]) }}"
                                   class="block w-full text-center btn-primary">
                                    Book This Package
                                </a>
                                <a href="{{ route('contact.index') }}"
                                   class="block w-full text-center btn-outline">
                                    Ask Questions
                                </a>
                            </div>

                            <!-- Contact Info -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 mb-2">Need help choosing?</p>
                                    <a href="tel:+6281234567890" class="text-gold-500 hover:text-gold-600 font-medium">
                                        +62 812-3456-7890
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-900 mb-4">Why Choose Us?</h3>
                        <div class="space-y-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                5+ years experience
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                500+ happy clients
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Professional equipment
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Fast delivery
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
