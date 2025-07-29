@extends('layouts.app')

@section('title', 'Book Your Photography Session - TazeenCreative')
@section('description', 'Professional photography booking form with premium UI/UX design. Select packages, schedule sessions, and capture your special moments.')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .floating-label-group {
        position: relative;
    }

    .floating-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid #e5e7eb;
        border-radius: 1rem;
        background: white;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .floating-input:focus {
        outline: none;
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    .floating-label {
        position: absolute;
        left: 3rem;
        top: 1rem;
        background: white;
        padding: 0 0.5rem;
        color: #6b7280;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .floating-input:focus ~ .floating-label,
    .floating-input:not(:placeholder-shown) ~ .floating-label {
        transform: translateY(-2rem) scale(0.875);
        color: #f59e0b;
        font-weight: 500;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 1rem;
        z-index: 10;
    }

    .package-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .package-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .package-card.selected {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    .style-tag {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .style-tag:hover {
        background-color: #e0e7ff;
        border-color: #a5b4fc;
    }

    .style-tag.selected {
        background-color: #e0e7ff !important;
        border-color: #6366f1 !important;
        color: #4338ca !important;
    }

    /* Budget slider styling */
    .budget-slider {
        -webkit-appearance: none;
        appearance: none;
        background: linear-gradient(to right, #10B981 0%, #10B981 30%, #E5E7EB 30%, #E5E7EB 100%);
        outline: none;
        height: 8px;
        border-radius: 5px;
    }

    .budget-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #10B981;
        cursor: pointer;
        border: 3px solid white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .budget-slider::-moz-range-thumb {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #10B981;
        cursor: pointer;
        border: 3px solid white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .budget-range-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .budget-range-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .budget-range-card.selected {
        transform: translateY(-2px) scale(1.02);
    }

    /* Phone input styling */
    #client_phone.placeholder-style {
        color: #9CA3AF;
    }

    #client_phone:focus.placeholder-style {
        color: #1F2937;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    @keyframes pulseGlow {
        0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
        100% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); }
    }

    .animate-fade-in { animation: fadeIn 0.5s ease-in-out; }
    .animate-slide-up { animation: slideUp 0.6s ease-out; }
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-pulse-glow { animation: pulseGlow 2s ease-in-out infinite alternate; }
</style>
@endpush

@section('content')
<!-- Floating Background Elements -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute top-20 left-10 w-32 h-32 bg-yellow-200 rounded-full opacity-20 animate-float"></div>
    <div class="absolute top-40 right-20 w-24 h-24 bg-yellow-300 rounded-full opacity-30 animate-float" style="animation-delay: -2s;"></div>
    <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-yellow-100 rounded-full opacity-25 animate-float" style="animation-delay: -4s;"></div>
</div>

<!-- Hero Section -->
<section class="relative min-h-[60vh] bg-gradient-to-r from-black via-gray-900 to-black flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="1"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>

    <div class="relative z-10 text-center text-white max-w-4xl mx-auto px-6">
        <div class="animate-slide-up">
            <h1 class="text-5xl md:text-7xl font-serif font-bold mb-6 bg-gradient-to-r from-yellow-400 to-yellow-600 bg-clip-text text-transparent">
                Capture Your Story
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-gray-300 font-light">
                Professional photography sessions that transform moments into memories
            </p>
            <div class="flex items-center justify-center space-x-6 text-yellow-400">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-star"></i>
                    <span class="text-sm">500+ Happy Clients</span>
                </div>
                <div class="w-1 h-1 bg-yellow-400 rounded-full"></div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-camera"></i>
                    <span class="text-sm">Professional Equipment</span>
                </div>
                <div class="w-1 h-1 bg-yellow-400 rounded-full"></div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-clock"></i>
                    <span class="text-sm">Fast Delivery</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
        <i class="fas fa-chevron-down text-2xl opacity-70"></i>
    </div>
</section>

<!-- Main Booking Form -->
<section class="py-20 relative">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden border border-white/20 animate-fade-in">
            <!-- Progress Indicator -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-6">
                <div class="flex items-center justify-between text-white">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-serif font-bold">Book Your Session</h2>
                            <p class="text-yellow-100">Complete your booking information</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-yellow-100">Trusted by</p>
                            <p class="font-bold">500+ Clients</p>
                        </div>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('booking.store') }}" class="p-8 space-y-8" id="booking-form">
                @csrf

                <!-- Service Selection -->
                <div class="group">
                    <div class="bg-gradient-to-r from-yellow-50 to-yellow-100/50 p-8 rounded-2xl border border-yellow-200 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-camera text-white text-sm"></i>
                            </div>
                            <h3 class="text-2xl font-semibold text-gray-800">Choose Your Package</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($services as $service)
                            <div class="package-card bg-white p-6 rounded-xl border-2 border-transparent hover:border-yellow-400 transition-all duration-300 transform hover:scale-105 {{ $selectedService && $selectedService->id == $service->id ? 'selected border-yellow-400' : '' }}"
                                 data-service-id="{{ $service->id }}">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-{{ ['blue', 'yellow', 'purple'][($loop->index) % 3] }}-500 to-{{ ['blue', 'yellow', 'purple'][($loop->index) % 3] }}-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-{{ ['user', 'heart', 'building'][($loop->index) % 3] }} text-white text-xl"></i>
                                    </div>
                                    <h4 class="font-bold text-lg mb-2">{{ $service->name }}</h4>
                                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($service->description, 50) }}</p>
                                    <div class="text-2xl font-bold text-yellow-600">{{ $service->formatted_price }}</div>
                                    @if($loop->index == 1)
                                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                                        <span class="bg-yellow-500 text-white px-4 py-1 rounded-full text-xs font-bold">POPULAR</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <input type="hidden" name="service_id" id="service_id" value="{{ $selectedService->id ?? '' }}" required>
                        @error('service_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Client Information -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100/50 p-8 rounded-2xl border border-blue-200">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Your Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="floating-label-group">
                            <input type="text" name="client_name" id="client_name" class="floating-input peer"
                                   value="{{ old('client_name', auth()->user()->name ?? '') }}" placeholder=" " required>
                            <label for="client_name" class="floating-label">Full Name *</label>
                            <div class="input-icon">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            @error('client_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="floating-label-group">
                            <input type="email" name="client_email" id="client_email" class="floating-input peer"
                                   value="{{ old('client_email', auth()->user()->email ?? '') }}" placeholder=" " required>
                            <label for="client_email" class="floating-label">Email Address *</label>
                            <div class="input-icon">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            @error('client_email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="floating-label-group">
                            <input type="tel" name="client_phone" id="client_phone" class="floating-input peer placeholder-style"
                                   value="{{ old('client_phone', '+62 812-3456-7890') }}" placeholder="+62 812-3456-7890" required>
                            <label for="client_phone" class="floating-label">Phone Number *</label>
                            <div class="input-icon">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <div class="mt-2">
                                <div class="flex items-center text-xs text-gray-500">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    <span>Format: +62 812-3456-7890 (Indonesian mobile number)</span>
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    We'll use WhatsApp for quick session updates and coordination
                                </div>
                            </div>
                            @error('client_phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Session Details -->
                <div class="bg-gradient-to-r from-purple-50 to-purple-100/50 p-8 rounded-2xl border border-purple-200">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar text-white text-sm"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Session Details</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="floating-label-group">
                            <input type="date" name="booking_date" id="booking_date" class="floating-input peer"
                                   value="{{ old('booking_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            <label for="booking_date" class="floating-label">Preferred Date *</label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            @error('booking_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="floating-label-group">
                            <select name="booking_time" id="booking_time" class="floating-input peer" required>
                                <option value=""></option>
                                <option value="08:00" {{ old('booking_time') == '08:00' ? 'selected' : '' }}>08:00 - Morning Golden Hour</option>
                                <option value="10:00" {{ old('booking_time') == '10:00' ? 'selected' : '' }}>10:00 - Mid Morning</option>
                                <option value="13:00" {{ old('booking_time') == '13:00' ? 'selected' : '' }}>13:00 - Midday Light</option>
                                <option value="15:00" {{ old('booking_time') == '15:00' ? 'selected' : '' }}>15:00 - Afternoon Glow</option>
                                <option value="17:00" {{ old('booking_time') == '17:00' ? 'selected' : '' }}>17:00 - Golden Hour</option>
                            </select>
                            <label for="booking_time" class="floating-label">Preferred Time *</label>
                            <div class="input-icon">
                                <i class="fas fa-clock text-gray-400"></i>
                            </div>
                            @error('booking_time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="floating-label-group">
                            <input type="text" name="location" id="location" class="floating-input peer"
                                   value="{{ old('location') }}" placeholder=" " required>
                            <label for="location" class="floating-label">Session Location *</label>
                            <div class="input-icon">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            @error('location')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Enhanced Budget Range -->
                <div class="bg-gradient-to-r from-green-50 to-green-100/50 p-8 rounded-2xl border border-green-200">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-dollar-sign text-white text-sm"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Budget Range</h3>
                        <div class="ml-auto">
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Choose your comfort zone</span>
                        </div>
                    </div>

                    <!-- Budget Slider with Visual Guide -->
                    <div class="mb-8">
                        <div class="relative">
                            <!-- Budget Range Slider -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Select your budget range (IDR)</label>
                                <div class="relative">
                                    <input type="range" id="budget-slider" min="500000" max="50000000" step="500000" value="3000000"
                                           class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer budget-slider">

                                    <!-- Budget Scale -->
                                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                                        <span>500K</span>
                                        <span>5M</span>
                                        <span>15M</span>
                                        <span>30M</span>
                                        <span>50M+</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Selected Budget Display -->
                            <div class="bg-white p-6 rounded-xl border-2 border-green-200 mb-6">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-green-600 mb-2" id="selected-budget">Rp 3.000.000</div>
                                    <div class="text-sm text-gray-600" id="budget-category">Premium Package Range</div>
                                    <div class="text-xs text-gray-500 mt-1" id="budget-description">Perfect for professional portraits and events</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Manual Budget Input (Alternative) -->
                    <div class="border-t border-green-200 pt-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-gray-800">Or set custom range</h4>
                            <button type="button" id="toggle-manual-budget" class="text-sm text-green-600 hover:text-green-700 flex items-center">
                                <i class="fas fa-edit mr-1"></i>
                                Custom Budget
                            </button>
                        </div>

                        <div id="manual-budget-inputs" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="floating-label-group">
                                <input type="number" name="budget_min_manual" id="budget_min_manual" class="floating-input peer"
                                       value="{{ old('budget_min', 2000000) }}" placeholder=" " min="500000" step="100000">
                                <label for="budget_min_manual" class="floating-label">Minimum Budget (IDR) *</label>
                                <div class="input-icon">
                                    <i class="fas fa-coins text-gray-400"></i>
                                </div>
                            </div>

                            <div class="floating-label-group">
                                <input type="number" name="budget_max_manual" id="budget_max_manual" class="floating-input peer"
                                       value="{{ old('budget_max', 8000000) }}" placeholder=" " min="500000" step="100000">
                                <label for="budget_max_manual" class="floating-label">Maximum Budget (IDR) *</label>
                                <div class="input-icon">
                                    <i class="fas fa-coins text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Budget Helper with Database-driven suggestions -->
                    <div class="mt-6 p-6 bg-white rounded-xl border border-green-200">
                        <div class="flex items-start space-x-3 mb-4">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-lightbulb text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-800 mb-2">Budget Recommendations</h5>
                                <p class="text-sm text-gray-600 mb-3">Based on our most popular packages and client preferences</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @php
                            // This would typically come from your database
                            $budgetRanges = [
                                [
                                    'name' => 'Essential',
                                    'min' => 500000,
                                    'max' => 2000000,
                                    'color' => 'blue',
                                    'popular' => false,
                                    'description' => 'Basic sessions, 1-2 hours',
                                    'includes' => ['20-30 edited photos', 'Basic retouching', 'Online gallery']
                                ],
                                [
                                    'name' => 'Premium',
                                    'min' => 2000000,
                                    'max' => 8000000,
                                    'color' => 'yellow',
                                    'popular' => true,
                                    'description' => 'Professional sessions, 2-4 hours',
                                    'includes' => ['50-80 edited photos', 'Professional retouching', 'Print release']
                                ],
                                [
                                    'name' => 'Luxury',
                                    'min' => 8000000,
                                    'max' => 50000000,
                                    'color' => 'purple',
                                    'popular' => false,
                                    'description' => 'Premium experiences, full day',
                                    'includes' => ['100+ edited photos', 'Advanced retouching', 'Custom album']
                                ]
                            ];
                            @endphp

                            @foreach($budgetRanges as $range)
                            <div class="budget-range-card relative p-4 border-2 border-{{ $range['color'] }}-200 rounded-xl cursor-pointer hover:border-{{ $range['color'] }}-400 transition-all duration-300 hover:shadow-lg"
                                 data-min="{{ $range['min'] }}" data-max="{{ $range['max'] }}" data-name="{{ $range['name'] }}">

                                @if($range['popular'])
                                <div class="absolute -top-2 left-1/2 transform -translate-x-1/2">
                                    <span class="bg-{{ $range['color'] }}-500 text-white px-3 py-1 rounded-full text-xs font-bold">MOST POPULAR</span>
                                </div>
                                @endif

                                <div class="text-center">
                                    <div class="w-12 h-12 bg-{{ $range['color'] }}-500 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-{{ $range['color'] === 'blue' ? 'star' : ($range['color'] === 'yellow' ? 'crown' : 'gem') }} text-white"></i>
                                    </div>

                                    <h6 class="font-bold text-{{ $range['color'] }}-600 mb-1">{{ $range['name'] }}</h6>
                                    <div class="text-lg font-semibold text-gray-800 mb-1">
                                        Rp {{ number_format($range['min']/1000000, 1) }}M - {{ number_format($range['max']/1000000, 1) }}M
                                    </div>
                                    <p class="text-xs text-gray-600 mb-3">{{ $range['description'] }}</p>

                                    <div class="space-y-1">
                                        @foreach($range['includes'] as $feature)
                                        <div class="flex items-center text-xs text-gray-600">
                                            <i class="fas fa-check text-{{ $range['color'] }}-500 mr-2 flex-shrink-0"></i>
                                            <span>{{ $feature }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Budget Tips -->
                        <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-info-circle text-green-600 mt-1 flex-shrink-0"></i>
                                <div class="text-sm text-green-700">
                                    <strong>💡 Pro Tips:</strong>
                                    <ul class="list-disc list-inside mt-1 space-y-1">
                                        <li>Weekend sessions may have 20-30% premium pricing</li>
                                        <li>Multiple locations may require additional travel costs</li>
                                        <li>Rush delivery (under 7 days) includes express fee</li>
                                        <li>Large groups (10+ people) may need extended session time</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Hidden inputs for form submission -->
                    <input type="hidden" name="budget_min" id="final_budget_min" value="{{ old('budget_min', 2000000) }}">
                    <input type="hidden" name="budget_max" id="final_budget_max" value="{{ old('budget_max', 8000000) }}">
                </div>

                <!-- Requirements -->
                <div class="bg-gradient-to-r from-indigo-50 to-indigo-100/50 p-8 rounded-2xl border border-indigo-200">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-lightbulb text-white text-sm"></i>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-800">Tell Us Your Vision</h3>
                    </div>

                    <div class="floating-label-group">
                        <textarea name="requirements" id="requirements" rows="6" class="floating-input peer resize-none" placeholder=" ">{{ old('requirements') }}</textarea>
                        <label for="requirements" class="floating-label">Describe your photography needs, style preferences, or special requests...</label>
                        @error('requirements')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Style Suggestions -->
                    <div class="mt-6">
                        <p class="text-sm font-medium text-gray-700 mb-3">Popular styles:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Natural Light', 'Cinematic', 'Vintage', 'Modern', 'Dramatic', 'Minimalist'] as $style)
                            <span class="style-tag px-3 py-1 bg-white border border-indigo-200 rounded-full text-xs hover:bg-indigo-100 transition-colors">{{ $style }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-8 border-t border-gray-200">
                    <a href="{{ route('services.index') }}" class="px-8 py-4 border-2 border-gray-300 text-gray-700 rounded-2xl font-semibold hover:border-gray-400 hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 text-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Services
                    </a>
                    <button type="submit" class="px-12 py-4 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-2xl font-bold hover:from-yellow-600 hover:to-yellow-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl animate-pulse-glow">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Submit Booking Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Trust Indicators -->
<section class="py-20 bg-gradient-to-r from-gray-900 via-black to-gray-900">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-serif font-bold text-white mb-4">Why Choose TazeenCreative?</h2>
            <p class="text-xl text-gray-400">Excellence in every frame, memories that last forever</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-300 shadow-lg">
                    <i class="fas fa-award text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-white mb-3">Award Winning</h3>
                <p class="text-gray-400">Recognized excellence in photography with multiple industry awards</p>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-300 shadow-lg">
                    <i class="fas fa-shipping-fast text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-white mb-3">Fast Delivery</h3>
                <p class="text-gray-400">Professional editing and delivery within 7-14 days guaranteed</p>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-300 shadow-lg">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-white mb-3">500+ Happy Clients</h3>
                <p class="text-gray-400">Trusted by families, couples, and businesses across Indonesia</p>
            </div>

            <div class="text-center group">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform group-hover:scale-110 transition-all duration-300 shadow-lg">
                    <i class="fas fa-headset text-white text-2xl"></i>
                </div>
                <h3 class="font-bold text-xl text-white mb-3">24/7 Support</h3>
                <p class="text-gray-400">Always available to help you plan the perfect photography session</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Package selection functionality
    document.querySelectorAll('.package-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.package-card').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            document.getElementById('service_id').value = this.dataset.serviceId;
        });
    });

    // Budget Range functionality
    const budgetSlider = document.getElementById('budget-slider');
    const selectedBudgetDisplay = document.getElementById('selected-budget');
    const budgetCategoryDisplay = document.getElementById('budget-category');
    const budgetDescriptionDisplay = document.getElementById('budget-description');
    const toggleManualBudget = document.getElementById('toggle-manual-budget');
    const manualBudgetInputs = document.getElementById('manual-budget-inputs');
    const finalBudgetMin = document.getElementById('final_budget_min');
    const finalBudgetMax = document.getElementById('final_budget_max');

    // Budget categories with database-like structure
    const budgetCategories = {
        500000: { name: 'Basic', description: 'Simple portrait sessions', min: 500000, max: 1500000, color: 'blue' },
        1500000: { name: 'Standard', description: 'Professional portraits & couples', min: 1500000, max: 3000000, color: 'green' },
        3000000: { name: 'Premium', description: 'Professional events & weddings', min: 2000000, max: 8000000, color: 'yellow' },
        8000000: { name: 'Luxury', description: 'Premium weddings & commercial', min: 8000000, max: 20000000, color: 'purple' },
        20000000: { name: 'Elite', description: 'Exclusive luxury experiences', min: 20000000, max: 50000000, color: 'pink' }
    };

    function updateBudgetDisplay(value) {
        const numValue = parseInt(value);
        let category = budgetCategories[500000]; // default

        // Find appropriate category
        Object.keys(budgetCategories).forEach(key => {
            if (numValue >= parseInt(key)) {
                category = budgetCategories[key];
            }
        });

        selectedBudgetDisplay.textContent = formatCurrency(numValue);
        budgetCategoryDisplay.textContent = `${category.name} Package Range`;
        budgetDescriptionDisplay.textContent = category.description;

        // Update hidden inputs
        finalBudgetMin.value = category.min;
        finalBudgetMax.value = category.max;

        // Update slider background
        const percentage = ((numValue - 500000) / (50000000 - 500000)) * 100;
        budgetSlider.style.background = `linear-gradient(to right, #10B981 0%, #10B981 ${percentage}%, #E5E7EB ${percentage}%, #E5E7EB 100%)`;
    }

    function formatCurrency(amount) {
        if (amount >= 1000000) {
            return `Rp ${(amount / 1000000).toFixed(1)}M`;
        } else {
            return `Rp ${(amount / 1000).toFixed(0)}K`;
        }
    }

    // Budget slider event
    budgetSlider.addEventListener('input', function() {
        updateBudgetDisplay(this.value);
    });

    // Initialize budget display
    updateBudgetDisplay(budgetSlider.value);

    // Budget range card selection
    document.querySelectorAll('.budget-range-card').forEach(card => {
        card.addEventListener('click', function() {
            const min = this.dataset.min;
            const max = this.dataset.max;
            const name = this.dataset.name;

            // Remove selected class from all cards
            document.querySelectorAll('.budget-range-card').forEach(c =>
                c.classList.remove('ring-2', 'ring-yellow-400', 'bg-yellow-50'));

            // Add selected class to clicked card
            this.classList.add('ring-2', 'ring-yellow-400', 'bg-yellow-50');

            // Update slider and displays
            const midpoint = (parseInt(min) + parseInt(max)) / 2;
            budgetSlider.value = midpoint;
            updateBudgetDisplay(midpoint);

            // Update display
            selectedBudgetDisplay.textContent = `${formatCurrency(min)} - ${formatCurrency(max)}`;
            budgetCategoryDisplay.textContent = `${name} Package Selected`;
        });
    });

    // Toggle manual budget inputs
    toggleManualBudget.addEventListener('click', function() {
        manualBudgetInputs.classList.toggle('hidden');
        const isHidden = manualBudgetInputs.classList.contains('hidden');
        this.innerHTML = isHidden ?
            '<i class="fas fa-edit mr-1"></i>Custom Budget' :
            '<i class="fas fa-times mr-1"></i>Use Slider';
    });

    // Manual budget input validation
    const budgetMinInput = document.getElementById('budget_min_manual');
    const budgetMaxInput = document.getElementById('budget_max_manual');

    if (budgetMinInput && budgetMaxInput) {
        budgetMinInput.addEventListener('input', function() {
            const minVal = parseInt(this.value);
            budgetMaxInput.min = minVal;
            finalBudgetMin.value = minVal;

            if (parseInt(budgetMaxInput.value) < minVal) {
                budgetMaxInput.value = minVal + 500000;
                finalBudgetMax.value = minVal + 500000;
            }
        });

        budgetMaxInput.addEventListener('input', function() {
            const maxVal = parseInt(this.value);
            finalBudgetMax.value = maxVal;

            if (maxVal < parseInt(budgetMinInput.value)) {
                this.value = budgetMinInput.value;
                finalBudgetMax.value = budgetMinInput.value;
            }
        });
    }

    // Enhanced Phone Number functionality
    const phoneInput = document.getElementById('client_phone');
    const placeholder = '+62 812-3456-7890';

    const validPrefixes = [
  // Telkomsel
  '811','812','813','821','822','823','851','852','853',
  // Indosat Ooredoo (Indosat + Tri)
  '814','815','816','855','856','857','858','895','896','897','898','899',
  // XL & Axis
  '817','818','819','831','832','833','838','859','877','878',
  // Smartfren
  '881','882','883','884','885','886','887','888','889'
];


    function formatIndoNumber(cleaned) {
        let formatted = '+62';
        const local = cleaned.slice(3);

        if (local.length > 0) formatted += ' ' + local.slice(0, 3);
        if (local.length > 3) formatted += '-' + local.slice(3, 7);
        if (local.length > 7) formatted += '-' + local.slice(7, 11);
        return formatted;
    }

    function normalizeNumber(value) {
        let cleaned = value.replace(/[^\d+]/g, '');
        if (!cleaned.startsWith('+62')) {
            if (cleaned.startsWith('62')) cleaned = '+' + cleaned;
            else if (cleaned.startsWith('0')) cleaned = '+62' + cleaned.slice(1);
            else if (cleaned.startsWith('+')) cleaned = '+62';
            else cleaned = '+62' + cleaned;
        }
        return cleaned.slice(0, 14); // maksimal 14 digit setelah +62
    }

    phoneInput.addEventListener('focus', function () {
        if (this.value === '' || this.value === placeholder) {
            this.value = '+62 ';
            this.classList.remove('placeholder-style');
            this.setSelectionRange(4, 4);
        }
    });

    phoneInput.addEventListener('input', function (e) {
        const normalized = normalizeNumber(e.target.value);
        const formatted = formatIndoNumber(normalized);
        e.target.value = formatted;

        const prefix = normalized.slice(3, 6);
        const validationMsg = this.parentElement.querySelector('.validation-msg');
        if (validationMsg) validationMsg.remove();

        if (normalized.length >= 6 && !validPrefixes.includes(prefix)) {
            const msg = document.createElement('div');
            msg.className = 'validation-msg text-xs text-amber-600 mt-1 flex items-center';
            msg.innerHTML = '<i class="fas fa-exclamation-triangle mr-1"></i>Prefix <strong>' + prefix + '</strong> tidak valid sebagai nomor HP Indonesia.';
            this.parentElement.appendChild(msg);
        }
    });

    const regex = /^(?:\+62[1-9]\d{7,10}|0?8[1-9]\d{7,10})$/;

    phoneInput.addEventListener('input', function(e) {
  const raw = e.target.value;
  const cleaned = raw.replace(/[^\d\+]/g, '');
  const isValid = regex.test(cleaned);
  const validationMsg = this.parentElement.querySelector('.validation-msg');
  if (validationMsg) validationMsg.remove();

  if (cleaned.length >= 11 && !isValid) {
    const msg = document.createElement('div');
    msg.className = 'validation-msg text-xs text-amber-600 mt-1 flex items-center';
    msg.innerHTML = `<i class="fas fa-exclamation-triangle mr-1"></i>Nomor tidak cocok format + prefix HP seluler Indonesia.`;
    this.parentElement.appendChild(msg);
  }
});

    // Init
    if (phoneInput.value === '' || phoneInput.value === placeholder) {
        phoneInput.classList.add('placeholder-style');
    }

    // Style tag functionality
    document.querySelectorAll('.style-tag').forEach(tag => {
        tag.addEventListener('click', function() {
            this.classList.toggle('selected');

            // Add selected styles to requirements textarea
            const selectedStyles = Array.from(document.querySelectorAll('.style-tag.selected')).map(t => t.textContent.trim());
            const requirementsTextarea = document.getElementById('requirements');

            if (selectedStyles.length > 0) {
                const currentText = requirementsTextarea.value;
                const styleText = `Photography Style Preferences: ${selectedStyles.join(', ')}\n\n`;

                // Remove existing style preferences if any
                const cleanText = currentText.replace(/Photography Style Preferences:.*?\n\n/g, '');
                requirementsTextarea.value = styleText + cleanText;
            }
        });
    });

    // Form submission with loading state
    const form = document.getElementById('booking-form');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        // Validate service selection
        if (!document.getElementById('service_id').value) {
            e.preventDefault();
            alert('Please select a photography package first.');
            return;
        }

        // Show loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
        submitBtn.disabled = true;

        // Re-enable button if form validation fails
        setTimeout(() => {
            if (submitBtn.disabled) {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        }, 5000);
    });

    // Floating label enhancements
    document.querySelectorAll('.floating-input').forEach(input => {
        // Set initial state for pre-filled inputs
        if (input.value.trim() !== '' && !input.classList.contains('placeholder-style')) {
            input.classList.add('has-value');
        }

        input.addEventListener('blur', function() {
            if (this.value.trim() !== '' && !this.classList.contains('placeholder-style')) {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });

    // Success/Error message handling from your app layout
    @if(session('success'))
        console.log('Success message handled by app layout');
    @endif

    @if($errors->any())
        // Smooth scroll to form sections on error
        setTimeout(() => {
            const firstError = document.querySelector('.text-red-600');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 500);
    @endif
});
</script>
@endpush
