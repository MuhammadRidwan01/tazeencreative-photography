@extends('layouts.app')

@section('title', 'Photography Services')
@section('description', 'Professional photography services including wedding, portrait, product, and event photography packages with competitive pricing.')

@push('styles')
<style>
    .floating-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(245, 158, 11, 0.6);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
    .particle:nth-child(2) { left: 20%; animation-delay: 1s; }
    .particle:nth-child(3) { left: 30%; animation-delay: 2s; }
    .particle:nth-child(4) { left: 40%; animation-delay: 3s; }
    .particle:nth-child(5) { left: 50%; animation-delay: 4s; }
    .particle:nth-child(6) { left: 60%; animation-delay: 0.5s; }
    .particle:nth-child(7) { left: 70%; animation-delay: 1.5s; }
    .particle:nth-child(8) { left: 80%; animation-delay: 2.5s; }
    .particle:nth-child(9) { left: 90%; animation-delay: 3.5s; }

    @keyframes float {
        0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
    }

    .hero-gradient {
        background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #2d1810 100%);
    }

    .service-card {
        position: relative;
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        transform-style: preserve-3d;
        height: fit-content;
    }

    .service-card:hover {
        transform: translateY(-20px) rotateX(5deg);
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.2);
    }

    .service-card.popular {
        background: linear-gradient(145deg, #fff7ed 0%, #fed7aa 100%);
        border: 2px solid #f59e0b;
        box-shadow: 0 0 40px rgba(245, 158, 11, 0.3);
    }

    .service-card.popular:hover {
        box-shadow: 0 40px 80px rgba(245, 158, 11, 0.4);
    }

    .card-glow {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #f59e0b, transparent);
        transform: translateX(-100%);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        50% { transform: translateX(0%); }
        100% { transform: translateX(100%); }
    }

    .price-tag {
        position: relative;
        display: inline-block;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 16px;
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 1rem;
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.3);
        overflow: hidden;
    }

    .price-tag.gold {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
    }

    .price-tag.silver {
        background: linear-gradient(135deg, #64748b 0%, #475569 100%);
        box-shadow: 0 8px 25px rgba(100, 116, 139, 0.3);
    }

    .price-tag::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        animation: priceShine 3s ease-in-out infinite;
    }

    @keyframes priceShine {
        0% { left: -100%; }
        50% { left: 0%; }
        100% { left: 100%; }
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .feature-item:hover {
        background: rgba(245, 158, 11, 0.05);
        transform: translateX(8px);
    }

    .feature-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: #f59e0b;
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .feature-item:hover::before {
        transform: scaleY(1);
    }

    .feature-icon {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        padding: 6px;
        margin-right: 12px;
        animation: pulse 2s ease-in-out infinite;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    .btn-magical {
        position: relative;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-magical:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-magical::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .btn-magical:hover::before {
        left: 100%;
    }

    .btn-outline-magical {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        padding: 16px 32px;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .btn-outline-magical::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .btn-outline-magical:hover::after {
        left: 0;
    }

    .btn-outline-magical:hover {
        color: white;
        border-color: transparent;
        text-decoration: none;
    }

    .popular-badge {
        position: absolute;
        top: -8px;
        right: 20px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: black;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        animation: bounce 2s ease-in-out infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .service-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 32px;
        align-items: start;
    }

    .comparison-table {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .faq-item {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        margin-bottom: 16px;
        overflow: hidden;
        border: 1px solid rgba(245, 158, 11, 0.2);
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        border-color: #f59e0b;
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.2);
    }

    .fade-in-up {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease;
    }

    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .stagger-1 { transition-delay: 0.1s; }
    .stagger-2 { transition-delay: 0.2s; }
    .stagger-3 { transition-delay: 0.3s; }

    .section-bg {
        position: relative;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .section-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(circle at 25% 25%, rgba(245, 158, 11, 0.1) 0%, transparent 50%),
                          radial-gradient(circle at 75% 75%, rgba(99, 102, 241, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }

    /* Utility classes */
    .container-custom {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-padding {
        padding: 80px 0;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(245, 158, 11, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid currentColor;
        padding: 12px 24px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: all 0.3s ease;
    }

    /* Ripple effect */
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .service-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .price-tag {
            font-size: 1.5rem;
            padding: 8px 16px;
        }

        .service-card {
            margin: 0 16px;
        }

        .hero-gradient h1 {
            font-size: 3rem;
        }

        .comparison-table {
            margin: 0 16px;
        }

        .section-padding {
            padding: 60px 0;
        }
    }

    @media (max-width: 480px) {
        .hero-gradient h1 {
            font-size: 2.5rem;
        }

        .btn-magical, .btn-outline-magical {
            padding: 12px 24px;
            font-size: 1rem;
        }

        .section-padding {
            padding: 40px 0;
        }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="relative h-96 hero-gradient flex items-center justify-center overflow-hidden">
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
             alt="Photography Services"
             class="w-full h-full object-cover opacity-30">
    </div>

    <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-4">
        <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6 bg-gradient-to-r from-white via-yellow-200 to-orange-300 bg-clip-text text-transparent">
            Our Services
        </h1>
        <p class="text-xl md:text-2xl opacity-90 leading-relaxed">
            Professional photography packages crafted with passion and precision
        </p>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding">
    <div class="container-custom">
        @if($services->count())
            <div class="service-grid">
                @foreach($services as $index => $service)
                    <div class="service-card fade-in-up z-[99] stagger-{{ ($index % 3) + 1 }} {{ $service->is_popular ? 'popular' : '' }}" data-animate="slide-up">

                        @if($service->is_popular)
                            <div class="popular-badge">✨ MOST POPULAR</div>
                        @endif

                        <div class="card-glow"></div>

                        <!-- Header -->
                        <div class="p-8 text-center">
                            <h3 class="text-3xl font-serif font-bold text-gray-900 mb-6">{{ $service->name }}</h3>

                            <div class="price-tag {{ $service->package_type === 'basic' ? 'silver' : ($service->package_type === 'premium' ? '' : 'gold') }}">
                                Start from {{ 'Rp ' . number_format($service->price_start, 0, ',', '.') }}
                            </div>

                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ \Illuminate\Support\Str::limit($service->description, 120) }}
                            </p>

                            <!-- Duration -->
                            <div class="inline-flex items-center bg-gray-100 rounded-full px-6 py-3 text-sm font-medium text-gray-700">
                                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $service->duration_hours }} Hours Session
                            </div>
                        </div>

                        <!-- Features -->
                        <div class="px-8 pb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4 text-center">What's Included</h4>
                            <div class="space-y-2">
                                @foreach(($service->features ?? []) as $idx => $feature)
                                    <div class="feature-item" style="animation-delay: {{ $idx * 0.1 }}s">
                                        <div class="feature-icon">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </div>
                                        <span class="text-gray-700 font-medium">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="p-8 pt-0 space-y-4">
                            <a href="{{ route('services.show', $service) }}"
                               class="block w-full text-center btn-outline-magical py-4 rounded-2xl font-semibold transition-all duration-300">
                                View Details
                            </a>
                            <a href="{{ route('booking.create', ['service' => $service]) }}"
                               class="block w-full text-center btn-magical py-4 rounded-2xl font-semibold">
                                Book Now ✨
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- empty‑state -->
            <div class="text-center py-20 fade-in-up">
                <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Amazing Services Coming Soon</h3>
                <p class="text-gray-600 text-lg">We're crafting extraordinary photography packages just for you.</p>
            </div>
        @endif
    </div>
</section>

<!-- Comparison Table -->
@if($services->count() > 1)
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 bg-gradient-to-r from-gray-900 via-indigo-800 to-purple-800 bg-clip-text text-transparent">
                    Compare Our Packages
                </h2>
                <p class="text-xl text-gray-600">Find the perfect fit for your photography needs</p>
            </div>

            <div class="comparison-table fade-in-up">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <!-- Header -->
                        <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                            <tr>
                                <th class="px-8 py-6 text-left text-sm font-bold uppercase tracking-wider">Features</th>
                                @foreach($services as $service)
                                    <th class="px-8 py-6 text-center text-sm font-bold uppercase tracking-wider">
                                        <div class="space-y-2">
                                            <div>{{ $service->name }}</div>
                                            @if($service->is_popular)
                                                <div class="inline-block bg-yellow-400 text-black text-xs font-bold px-2 py-1 rounded-full">
                                                    ⭐ POPULAR
                                                </div>
                                            @endif
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>

                        <!-- Body -->
                        <tbody class="divide-y divide-gray-200">
                            <!-- Investment row -->
                            <tr class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                <td class="px-8 py-6 font-bold text-gray-900">Investment</td>
                                @foreach($services as $service)
                                    <td class="px-8 py-6 text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ $service->formatted_price }}</div>
                                    </td>
                                @endforeach
                            </tr>

                            <!-- Duration row -->
                            <tr class="bg-white hover:bg-gray-50 transition-colors">
                                <td class="px-8 py-6 font-bold text-gray-900">Session Duration</td>
                                @foreach($services as $service)
                                    <td class="px-8 py-6 text-center">
                                        <div class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            {{ $service->duration_hours }} hours
                                        </div>
                                    </td>
                                @endforeach
                            </tr>

                            @php
                                $allFeatures = $services->pluck('features')->flatten()->unique();
                            @endphp

                            @foreach($allFeatures as $feat)
                                <tr class="hover:bg-gray-50 transition-colors {{ $loop->even ? 'bg-gray-25' : 'bg-white' }}">
                                    <td class="px-8 py-6 font-medium text-gray-900">{{ $feat }}</td>

                                    @foreach($services as $service)
                                        <td class="px-8 py-6 text-center">
                                            @if(in_array($feat, $service->features ?? []))
                                                <div class="inline-flex items-center justify-center w-8 h-8 bg-green-100 rounded-full">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="inline-flex items-center justify-center w-8 h-8 bg-red-100 rounded-full">
                                                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach

                            <!-- CTA row -->
                            <tr class="bg-gradient-to-r from-indigo-50 to-purple-50">
                                <td class="px-8 py-6 font-bold text-gray-900">Book Now</td>
                                @foreach($services as $service)
                                    <td class="px-8 py-6 text-center">
                                        <a href="{{ route('booking.create', ['service' => $service]) }}"
                                           class="btn-magical inline-block px-6 py-3 text-sm">
                                            Book Session
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
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl md:text-5xl font-serif font-bold mb-6 bg-gradient-to-r from-purple-800 via-indigo-800 to-blue-800 bg-clip-text text-transparent">
                Frequently Asked Questions
            </h2>
            <p class="text-xl text-gray-600">Everything you need to know about our photography services</p>
        </div>

        <div class="max-w-3xl mx-auto">
            <div class="faq-item fade-in-up stagger-1">
                <button class="w-full px-8 py-6 text-left flex items-center justify-between font-semibold text-gray-900 hover:text-indigo-600 transition-colors" data-faq-toggle>
                    <span>What's included in each photography package?</span>
                    <svg class="w-6 h-6 text-indigo-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-8 pb-6 text-gray-600 max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    Each package includes professional photography, expert editing, and digital delivery. Premium packages offer extended sessions, additional edited photos, and exclusive add-ons for the ultimate experience.
                </div>
            </div>

            <div class="faq-item fade-in-up stagger-2">
                <button class="w-full px-8 py-6 text-left flex items-center justify-between font-semibold text-gray-900 hover:text-indigo-600 transition-colors" data-faq-toggle>
                    <span>How quickly will I receive my edited photos?</span>
                    <svg class="w-6 h-6 text-indigo-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-8 pb-6 text-gray-600 max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    Your beautifully edited photos will be ready within 1-2 weeks after your session. We also offer express delivery for those who can't wait to relive their magical moments.
                </div>
            </div>

            <div class="faq-item fade-in-up stagger-3">
                <button class="w-full px-8 py-6 text-left flex items-center justify-between font-semibold text-gray-900 hover:text-indigo-600 transition-colors" data-faq-toggle>
                    <span>Can I customize my photography package?</span>
                    <svg class="w-6 h-6 text-indigo-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-8 pb-6 text-gray-600 max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    Absolutely! We love creating bespoke packages tailored to your unique vision. Contact us to discuss your dream photography experience and receive a personalized quote.
                </div>
            </div>

            <div class="faq-item fade-in-up stagger-1">
                <button class="w-full px-8 py-6 text-left flex items-center justify-between font-semibold text-gray-900 hover:text-indigo-600 transition-colors" data-faq-toggle>
                    <span>What's your rescheduling and cancellation policy?</span>
                    <svg class="w-6 h-6 text-indigo-500 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-8 pb-6 text-gray-600 max-h-0 overflow-hidden transition-all duration-500 ease-in-out">
                    We require 48 hours notice for any changes. Last-minute cancellations may incur a small fee, but weather-related rescheduling is always complimentary because perfect lighting is worth the wait!
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-black via-gray-900 to-black text-white overflow-hidden relative">
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
        <h2 class="text-3xl md:text-4xl font-serif font-bold mb-6">Ready to Create Magic?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">
            Let's transform your precious moments into timeless masterpieces. Your story deserves to be told beautifully.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="btn-secondary">
                Get Custom Quote
            </a>
            <a href="#" class="btn-outline border-white text-white hover:bg-white hover:text-black">
                Book Now
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });

    // FAQ Toggle functionality
    document.querySelectorAll('[data-faq-toggle]').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('svg');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';

            // Close all other FAQ items
            document.querySelectorAll('[data-faq-toggle]').forEach(otherButton => {
                if (otherButton !== this) {
                    const otherContent = otherButton.nextElementSibling;
                    const otherIcon = otherButton.querySelector('svg');
                    otherContent.style.maxHeight = '0px';
                    otherIcon.style.transform = 'rotate(0deg)';
                }
            });

            // Toggle current FAQ item
            if (isOpen) {
                content.style.maxHeight = '0px';
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });

    // Add hover effects to service cards
    document.querySelectorAll('.service-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-20px) rotateX(5deg) scale(1.02)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0deg) scale(1)';
        });
    });

    // Parallax effect for floating particles
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.particle');

        parallaxElements.forEach((element, index) => {
            const speed = (index + 1) * 0.1;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Button click effects
    document.querySelectorAll('.btn-magical, .btn-outline-magical').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');

            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});
</script>
@endpush
