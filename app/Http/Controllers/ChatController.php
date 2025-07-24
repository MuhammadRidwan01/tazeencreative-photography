<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $messages = ChatMessage::forUser(Auth::id())
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark messages as read
        ChatMessage::forUser(Auth::id())
            ->where('is_admin', true)
            ->unread()
            ->update(['is_read' => true]);

        return view('chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('chat-files', 'public');
        }

        $message = ChatMessage::create([
            'user_id' => Auth::id(),
            'message' => $validated['message'],
            'is_admin' => Auth::user()->isAdmin(),
            'file_path' => $filePath
        ]);

        return response()->json([
            'success' => true,
            'message' => $message->load('user')
        ]);
    }

    public function adminIndex()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $users = User::where('role', 'client')
            ->whereHas('chatMessages')
            ->withCount(['chatMessages as unread_count' => function ($query) {
                $query->where('is_admin', false)->where('is_read', false);
            }])
            ->orderBy('last_seen', 'desc')
            ->get();

        return view('admin.chat.index', compact('users'));
    }

    public function adminShow(User $user)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $messages = ChatMessage::forUser($user->id)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark client messages as read
        ChatMessage::forUser($user->id)
            ->where('is_admin', false)
            ->unread()
            ->update(['is_read' => true]);

        return view('admin.chat.show', compact('user', 'messages'));
    }

    public function adminReply(Request $request, User $user)
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = ChatMessage::create([
            'user_id' => $user->id,
            'message' => $validated['message'],
            'is_admin' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message->load('user')
        ]);
    }
}
