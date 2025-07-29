@extends('layouts.app')

@section('title', 'Booking History')
@section('description', 'View your photography booking history and track the status of your sessions with TazeenCreative.id.')

@section('content')
<!-- Hero Section -->
<section class="relative h-64 bg-black flex items-center justify-center">
    <div class="absolute inset-0">
        <img src="/placeholder.svg?height=400&width=1920"
             alt="Booking History"
             class="w-full h-full object-cover opacity-50">
    </div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Booking History</h1>
        <p class="text-xl">Track your photography sessions</p>
    </div>
</section>

<!-- Booking History Section -->
<section class="section-padding">
    <div class="container-custom">
        @if($bookings->count() > 0)
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">Your Bookings</h2>
                        <span class="text-sm text-gray-500">{{ $bookings->total() }} total bookings</span>
                    </div>
                </div>

                <!-- Bookings List -->
                <div class="divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                <!-- Booking Info -->
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                                {{ $booking->service->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600 mb-2">
                                                Booking ID: #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                                            </p>
                                            <div class="flex items-center text-sm text-gray-500 space-x-4">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $booking->booking_date->format('M d, Y') }}
                                                </span>
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $booking->booking_time->format('H:i') }}
                                                </span>
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    {{ $booking->location }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Status Badge -->
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $booking->status_badge }}">
                                            {{ $booking->status_text }}
                                        </span>
                                    </div>

                                    <!-- Price -->
                                    <div class="mb-4">
                                        <span class="text-lg font-semibold text-gray-900">{{ $booking->service->formatted_price }}</span>
                                        <span class="text-sm text-gray-500 ml-2">
                                            Budget: IDR {{ number_format($booking->budget_min, 0, ',', '.') }} - {{ number_format($booking->budget_max, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-col sm:flex-row gap-3 lg:ml-6">
                                    <a href="{{ route('booking.show', $booking) }}"
                                       class="btn-outline text-center">
                                        View Details
                                    </a>
                                    @if($booking->status === 'pending')
                                        <form method="POST" action="{{ route('booking.cancel', $booking) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg transition-all duration-300"
                                                    onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                Cancel Booking
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($bookings->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto h-24 w-24 text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">No Bookings Yet</h3>
                    <p class="text-lg text-gray-600 mb-8">
                        You haven't made any photography bookings yet. Start by exploring our services and book your first session.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('services.index') }}" class="btn-primary">
                            Browse Services
                        </a>
                        <a href="{{ route('booking.create') }}" class="btn-outline">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Quick Actions -->
@if($bookings->count() > 0)
    <section class="section-padding bg-gray-50">
        <div class="container-custom">
            <div class="text-center">
                <h2 class="text-3xl font-serif font-bold text-gray-900 mb-6">Need Something Else?</h2>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('booking.create') }}" class="btn-primary">
                        Book Another Session
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn-outline">
                        Contact Support
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="btn-outline">
                        View Portfolio
                    </a>
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
