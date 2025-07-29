<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ChatMessage;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_portfolios' => Portfolio::count(),
            'total_clients' => User::where('role', '!=', 'admin')->count(),
            'total_services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
        ];

        // Get unread messages count
        $unreadMessages = ChatMessage::whereHas('sender', function($query) {
            $query->where('role', '!=', 'admin');
        })->where('is_read', false)->count();

        // Recent bookings
        $recentBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        // Recent messages
        $recentMessages = ChatMessage::with(['sender', 'receiver'])
            ->whereHas('sender', function($query) {
                $query->where('role', '!=', 'admin');
            })
            ->latest()
            ->take(5)
            ->get();

        // Monthly bookings for chart
        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.dashboard', compact('stats', 'unreadMessages', 'recentBookings', 'recentMessages', 'monthlyBookings'));
    }
}
