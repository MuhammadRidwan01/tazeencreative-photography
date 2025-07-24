<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_portfolios' => Portfolio::count(),
            'total_clients' => User::where('role', 'client')->count(),
            'unread_messages' => ChatMessage::where('is_admin', false)->unread()->count(),
        ];

        $recentBookings = Booking::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'monthlyBookings'));
    }
}
