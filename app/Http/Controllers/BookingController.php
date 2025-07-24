<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;

    public function create(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $services = Service::where('is_active', true)->get();
        $selectedService = null;

        if ($request->has('service')) {
            $selectedService = Service::where('slug', $request->service)->first();
        }

        return view('booking.create', compact('services', 'selectedService'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'client_email' => 'required|email|max:255',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required',
            'location' => 'required|string|max:255',
            'budget_min' => 'required|numeric|min:0',
            'budget_max' => 'required|numeric|min:0|gte:budget_min',
            'requirements' => 'nullable|string'
        ]);

        $validated['user_id'] = Auth::id();

        $booking = Booking::create($validated);

        return redirect()->route('booking.history')
            ->with('success', 'Booking berhasil dibuat! Kami akan menghubungi Anda segera.');
    }

    public function history()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $bookings = Auth::user()->bookings()
            ->with('service')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('booking.history', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Simple authorization check
        if ($booking->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access.');
        }

        $booking->load('service');

        return view('booking.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Simple authorization check
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        if ($booking->status === 'pending') {
            $booking->update(['status' => 'cancelled']);
            return back()->with('success', 'Booking berhasil dibatalkan.');
        }

        return back()->with('error', 'Booking tidak dapat dibatalkan.');
    }
}
