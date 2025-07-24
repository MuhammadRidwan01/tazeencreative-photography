@extends('layouts.app')

@section('title', 'Buat Booking Baru')
@section('description', 'Buat booking untuk layanan fotografi profesional TazeenCreative.id. Pilih paket yang sesuai dengan kebutuhan Anda.')

@section('content')
<!-- Hero Section -->
<section class="relative h-64 bg-black flex items-center justify-center">
    <div class="absolute inset-0">
        <img src="/placeholder.svg?height=400&width=1920"
             alt="Book Photography Session"
             class="w-full h-full object-cover opacity-50">
    </div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Book Your Session</h1>
        <p class="text-xl">Let's capture your special moments</p>
    </div>
</section>

<!-- Booking Form Section -->
<section class="section-padding">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('booking.store') }}" class="space-y-8">
                        @csrf

                        <!-- Service Selection -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Select Photography Package</h3>
                            <div>
                                <label for="service_id" class="block text-sm font-medium text-gray-700 mb-2">Choose Package *</label>
                                <select name="service_id" id="service_id" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Select Photography Package</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}" {{ $selectedService && $selectedService->id == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }} - {{ $service->formatted_price }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Client Information -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Your Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" name="client_name" id="client_name"
                                           value="{{ old('client_name', auth()->user()->name ?? '') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                    @error('client_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="client_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                    <input type="email" name="client_email" id="client_email"
                                           value="{{ old('client_email', auth()->user()->email ?? '') }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                    @error('client_email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="client_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input type="tel" name="client_phone" id="client_phone"
                                       value="{{ old('client_phone') }}" required
                                       placeholder="+62 812-3456-7890"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                @error('client_phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Session Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-2">Preferred Date *</label>
                                    <input type="date" name="booking_date" id="booking_date"
                                           value="{{ old('booking_date') }}"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                    @error('booking_date')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="booking_time" class="block text-sm font-medium text-gray-700 mb-2">Preferred Time *</label>
                                    <select name="booking_time" id="booking_time" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                        <option value="">Select Time</option>
                                        <option value="08:00">08:00 - Morning</option>
                                        <option value="10:00">10:00 - Morning</option>
                                        <option value="13:00">13:00 - Afternoon</option>
                                        <option value="15:00">15:00 - Afternoon</option>
                                        <option value="17:00">17:00 - Evening</option>
                                    </select>
                                    @error('booking_time')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                                <input type="text" name="location" id="location"
                                       value="{{ old('location') }}"
                                       placeholder="e.g., Jakarta Selatan, Studio, Outdoor Location" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                @error('location')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Budget Range -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Budget Range</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="budget_min" class="block text-sm font-medium text-gray-700 mb-2">Minimum Budget (IDR) *</label>
                                    <input type="number" name="budget_min" id="budget_min"
                                           value="{{ old('budget_min') }}" min="0" required
                                           placeholder="1000000"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                    @error('budget_min')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="budget_max" class="block text-sm font-medium text-gray-700 mb-2">Maximum Budget (IDR) *</label>
                                    <input type="number" name="budget_max" id="budget_max"
                                           value="{{ old('budget_max') }}" min="0" required
                                           placeholder="5000000"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300">
                                    @error('budget_max')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Requirements -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Additional Requirements</h3>
                            <div>
                                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Tell us about your vision</label>
                                <textarea name="requirements" id="requirements" rows="6"
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent transition-all duration-300"
                                          placeholder="Describe your photography needs, style preferences, special requests, or any other details...">{{ old('requirements') }}</textarea>
                                @error('requirements')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6 border-t border-gray-200">
                            <a href="{{ route('services.index') }}"
                               class="btn-outline text-center">
                                Back to Services
                            </a>
                            <button type="submit" class="btn-primary">
                                Submit Booking Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trust Indicators -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Why Book With Us?</h2>
            <p class="text-lg text-gray-600">Professional photography services you can trust</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Professional Quality</h3>
                <p class="text-sm text-gray-600">High-end equipment and expert techniques</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Fast Delivery</h3>
                <p class="text-sm text-gray-600">Photos delivered within 1-2 weeks</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">500+ Happy Clients</h3>
                <p class="text-sm text-gray-600">Trusted by families and businesses</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">24/7 Support</h3>
                <p class="text-sm text-gray-600">Always here to help you</p>
            </div>
        </div>
    </div>
</section>
@endsection
