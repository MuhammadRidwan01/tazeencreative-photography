<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminChatController extends Controller
{
    /**
     * Display chat conversations
     */
    public function index()
    {
        // Get all users who have sent messages, with their latest message
        $conversations = User::where('role', '!=', 'admin')
            ->whereHas('sentMessages')
            ->with(['sentMessages' => function ($query) {
                $query->latest()->take(1);
            }])
            ->get()
            ->map(function ($user) {
                $latestMessage = ChatMessage::where(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)
                          ->orWhere('receiver_id', $user->id);
                })->latest()->first();

                $user->latest_message = $latestMessage;
                $user->unread_count = ChatMessage::where('sender_id', $user->id)
                    ->where('receiver_id', Auth::id())
                    ->where('is_read', false)
                    ->count();

                return $user;
            })
            ->sortByDesc(function ($user) {
                return $user->latest_message ? $user->latest_message->created_at : null;
            });

        return view('admin.chat.index', compact('conversations'));
    }

    /**
     * Show conversation with specific user
     */
    public function show(User $user)
    {
        $messages = ChatMessage::betweenUsers(Auth::id(), $user->id)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        ChatMessage::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return view('admin.chat.show', compact('user', 'messages'));
    }

    /**
     * Send message to user
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'message' => $validated['message'],
            'is_read' => false
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message->load('sender')
            ]);
        }

        return redirect()->route('admin.chat.show', $user)
            ->with('success', 'Message sent successfully');
    }
}
