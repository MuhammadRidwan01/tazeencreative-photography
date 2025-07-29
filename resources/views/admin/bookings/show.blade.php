@extends('layouts.admin')

@section('title', 'Booking Details')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Booking #{{ $booking->id }}</h1>
                    <p class="text-gray-600 mt-1">{{ $booking->service->name }} - {{ $booking->user->name }}</p>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                        @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($booking->status === 'confirmed') bg-blue-100 text-blue-800
                        @elseif($booking->status === 'in_progress') bg-purple-100 text-purple-800
                        @elseif($booking->status === 'completed') bg-green-100 text-green-800
                        @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                    <a href="{{ route('admin.bookings.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Bookings
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Booking Information -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b">
                        <h2 class="text-xl font-semibold text-gray-900">Booking Information</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Service</label>
                                <p class="text-gray-900 font-medium">{{ $booking->service->name }}</p>
                                <p class="text-sm text-gray-600">{{ ucfirst($booking->service->package_type ?? 'Standard') }} Package</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Event Date</label>
                                <p class="text-gray-900 font-medium">{{ $booking->booking_date->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">{{ $booking->booking_date->format('l') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Event Time</label>
                                <p class="text-gray-900 font-medium">{{ $booking->booking_time->format('H:i') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                                <p class="text-gray-900 font-medium">{{ $booking->service->duration_hours ?? 'Not specified' }} hours</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                                <p class="text-gray-900">{{ $booking->location }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Budget Range</label>
                                <p class="text-2xl font-bold text-green-600">
                                    Rp {{ number_format($booking->budget_min, 0, ',', '.') }} -
                                    Rp {{ number_format($booking->budget_max, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        @if($booking->requirements)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-gray-900">{{ $booking->requirements }}</p>
                                </div>
                            </div>
                        @endif

                        @if($booking->admin_notes)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <p class="text-gray-900">{{ $booking->admin_notes }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Client Information -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-green-50 to-emerald-50 border-b">
                        <h2 class="text-xl font-semibold text-gray-900">Client Information</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <p class="text-gray-900 font-medium">{{ $booking->client_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <p class="text-gray-900">{{ $booking->client_email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                <p class="text-gray-900">{{ $booking->client_phone }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">User Account</label>
                                <p class="text-gray-900">{{ $booking->user->name }} ({{ $booking->user->email }})</p>
                                <p class="text-sm text-gray-600">Member since {{ $booking->user->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Status Management -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b">
                        <h3 class="text-lg font-semibold text-gray-900">Status Management</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.bookings.updateStatus', $booking) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                                    <select name="status" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                        <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="in_progress" {{ $booking->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>

                                <button type="submit"
                                        class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-indigo-50 to-blue-50 border-b">
                        <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <a href="mailto:{{ $booking->client_email }}"
                           class="w-full flex items-center justify-center px-4 py-3 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Send Email
                        </a>

                        <a href="tel:{{ $booking->client_phone }}"
                           class="w-full flex items-center justify-center px-4 py-3 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Call Client
                        </a>

                        @if(Route::has('admin.chat.show'))
                        <a href="{{ route('admin.chat.show', $booking->user) }}"
                           class="w-full flex items-center justify-center px-4 py-3 bg-purple-100 hover:bg-purple-200 text-purple-700 rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Open Chat
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Booking Timeline -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b">
                        <h3 class="text-lg font-semibold text-gray-900">Booking Timeline</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-400 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Booking Created</p>
                                    <p class="text-xs text-gray-500">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            @if($booking->updated_at != $booking->created_at)
                                <div class="flex items-start space-x-3">
                                    <div class="w-2 h-2 bg-blue-400 rounded-full mt-2"></div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                        <p class="text-xs text-gray-500">{{ $booking->updated_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-purple-400 rounded-full mt-2"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Event Date</p>
                                    <p class="text-xs text-gray-500">{{ $booking->booking_date->format('d M Y') }} at {{ $booking->booking_time->format('H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
