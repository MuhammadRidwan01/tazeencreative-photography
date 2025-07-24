@extends('layouts.app')

@section('title', 'Photography Services')
@section('description', 'Professional photography services including wedding, portrait, product, and event photography packages with competitive pricing.')

@section('content')
<!-- Hero Section -->
<section class="relative h-64 bg-black flex items-center justify-center">
    <div class="absolute inset-0">
        <img src="/placeholder.svg?height=400&width=1920" 
             alt="Photography Services" 
             class="w-full h-full object-cover opacity-50">
    </div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Our Services</h1>
        <p class="text-xl">Professional photography packages for every occasion</p>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding">
    <div class="container-custom">
        @if($services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="bg-white rounded-lg shadow-xl overflow-hidden card-hover {{ $service->is_popular ? 'ring-2 ring-gold-500' : '' }}" data-animate="slide-up">
                        <!-- Header -->
                        <div class="p-8 {{ $service->package_type === 'basic' ? 'bg-gray-50' : ($service->package_type === 'premium' ? 'bg-blue-50' : 'bg-gold-50') }}">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-2xl font-serif font-bold text-gray-900">{{ $service->name }}</h3>
                                @if($service->is_popular)
                                    <span class="bg-gold-500 text-black text-xs font-bold px-3 py-1 rounded-full">
                                        POPULAR
                                    </span>
                                @endif
                            </div>
                            
                            <div class="mb-6">
                                <span class="text-4xl font-bold {{ $service->package_type === 'basic' ? 'text-gray-900' : ($service->package_type === 'premium' ? 'text-blue-600' : 'text-gold-600') }}">
                                    {{ $service->formatted_price }}
                                </span>
                            </div>
                            
                            <p class="text-gray-600 mb-6">{{ Str::limit($service->description, 120) }}</p>
                            
                            <!-- Duration -->
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $service->duration_hours }} hours session
                            </div>
                        </div>
                        
                        <!-- Features -->
                        <div class="p-8">
                            <ul class="space-y-3 mb-8">
                                @foreach($service->features as $feature)
                                    <li class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-600">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            
                            <!-- Actions -->
                            <div class="space-y-3">
                                <a href="{{ route('services.show', $service) }}" 
                                   class="block w-full text-center {{ $service->package_type === 'basic' ? 'btn-outline' : ($service->package_type === 'premium' ? 'bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-all duration-300' : 'btn-secondary') }}">
                                    View Details
                                </a>
                                <a href="{{ route('booking.create', ['service' => $service->slug]) }}" 
                                   class="block w-full text-center {{ $service->package_type === 'basic' ? 'btn-primary' : ($service->package_type === 'premium' ? 'btn-outline' : 'btn-primary') }}">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Services Coming Soon</h3>
                <p class="text-gray-600">We're preparing amazing photography packages for you.</p>
            </div>
        @endif
    </div>
</section>

<!-- Service Comparison -->
@if($services->count() > 1)
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">Compare Our Packages</h2>
                <p class="text-xl text-gray-600">Choose the perfect package for your needs</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Features</th>
                                @foreach($services as $service)
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $service->name }}
                                        @if($service->is_popular)
                                            <span class="block text-gold-500 font-bold">POPULAR</span>
                                        @endif
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Price</td>
                                @foreach($services as $service)
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900 font-semibold">
                                        {{ $service->formatted_price }}
                                    </td>
                                @endforeach
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Duration</td>
                                @foreach($services as $service)
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                        {{ $service->duration_hours }} hours
                                    </td>
                                @endforeach
                            </tr>
                            @php
                                $allFeatures = $services->pluck('features')->flatten()->unique();
                            @endphp
                            @foreach($allFeatures as $feature)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $feature }}</td>
                                    @foreach($services as $service)
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if(in_array($feature, $service->features))
                                                <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Book Now</td>
                                @foreach($services as $service)
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('booking.create', ['service' => $service->slug]) }}" 
                                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                            Book
                                        </a>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- FAQ Section -->
<section class="section-padding">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">Frequently Asked Questions</h2>
            <p class="text-xl text-gray-600">Everything you need to know about our services</p>
        </div>
        
        <div class="max-w-3xl mx-auto">
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">What's included in each package?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        Each package includes professional photography, basic editing, and digital delivery. Higher-tier packages include additional services like extended sessions, more edited photos, and premium add-ons.
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">How long does it take to receive photos?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        Typically, you'll receive your edited photos within 1-2 weeks after the session. Rush delivery is available for an additional fee.
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">Can I customize a package?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        We can customize any package to meet your specific needs. Contact us to discuss your requirements and get a personalized quote.
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <button class="w-full px-6 py-4 text-left flex items-center justify-between" data-faq-toggle>
                        <span class="font-medium text-gray-900">What's your cancellation policy?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-6 pb-4 text-gray-600" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                        We require 48 hours notice for cancellations. Cancellations made less than 24 hours before the session may incur a fee. Weather-related cancellations are rescheduled at no charge.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-black text-white">
    <div class="container-custom text-center">
        <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">Ready to Book Your Session?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
            Let's create beautiful memories together. Choose your package and book your photography session today.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="btn-secondary">
                Get Custom Quote
            </a>
            <a href="{{ route('booking.create') }}" class="btn-outline border-white text-white hover:bg-white hover:text-black">
                Book Now
            </a>
        </div>
    </div>
</section>
@endsection
