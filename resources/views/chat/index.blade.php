@extends('layouts.app')

@section('title', 'Live Chat')
@section('description', 'Chat directly with TazeenCreative.id team for instant support and photography consultation.')

@section('content')
<!-- Hero Section -->
<section class="relative h-64 bg-black flex items-center justify-center">
    <div class="absolute inset-0">
        <img src="/placeholder.svg?height=400&width=1920"
             alt="Live Chat Support"
             class="w-full h-full object-cover opacity-50">
    </div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Live Chat</h1>
        <p class="text-xl">Get instant support from our team</p>
    </div>
</section>

<!-- Chat Section -->
<section class="section-padding">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <!-- Chat Header -->
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gold-500 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">TazeenCreative Support</h2>
                                <p class="text-sm text-gray-600">We're here to help you</p>
                            </div>
                        </div>
                        <div class="flex items-center text-sm text-green-600">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            Online
                        </div>
                    </div>
                </div>

                <!-- Chat Messages -->
                <div id="chat-container" class="h-96 overflow-y-auto p-6 bg-gray-50 space-y-4">
                    @if($messages->count() > 0)
                        @foreach($messages as $message)
                            <div class="flex {{ $message->is_admin ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md">
                                    @if(!$message->is_admin)
                                        <div class="flex items-end space-x-2">
                                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div class="bg-white border border-gray-200 rounded-lg px-4 py-2 shadow-sm">
                                                <p class="text-sm text-gray-800">{{ $message->message }}</p>
                                                @if($message->file_path)
                                                    <a href="{{ Storage::url($message->file_path) }}" target="_blank"
                                                       class="text-xs text-blue-600 hover:text-blue-800 underline mt-1 block">
                                                        📎 View Attachment
                                                    </a>
                                                @endif
                                                <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->format('H:i') }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-end space-x-2 justify-end">
                                            <div class="bg-gold-500 text-white rounded-lg px-4 py-2 shadow-sm">
                                                <p class="text-sm">{{ $message->message }}</p>
                                                @if($message->file_path)
                                                    <a href="{{ Storage::url($message->file_path) }}" target="_blank"
                                                       class="text-xs text-gold-100 hover:text-white underline mt-1 block">
                                                        📎 View Attachment
                                                    </a>
                                                @endif
                                                <p class="text-xs text-gold-100 mt-1">{{ $message->created_at->format('H:i') }}</p>
                                            </div>
                                            <div class="w-8 h-8 bg-gold-500 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Welcome Message -->
                        <div class="flex justify-center">
                            <div class="max-w-md text-center">
                                <div class="w-16 h-16 bg-gold-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Welcome to Live Chat!</h3>
                                <p class="text-gray-600 text-sm">
                                    Hi there! 👋 We're here to help you with any questions about our photography services.
                                    Start a conversation below and we'll get back to you as soon as possible.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Chat Input -->
                <div class="bg-white border-t border-gray-200 p-4">
                    <form id="chat-form" class="flex items-end space-x-3">
                        @csrf
                        <div class="flex-1">
                            <textarea id="message-input"
                                      placeholder="Type your message here..."
                                      rows="2"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gold-500 focus:border-transparent resize-none transition-all duration-300"
                                      onkeydown="if(event.key==='Enter' && !event.shiftKey){event.preventDefault(); document.getElementById('chat-form').dispatchEvent(new Event('submit'));}"></textarea>
                        </div>
                        <button type="submit"
                                class="bg-gold-500 hover:bg-gold-600 text-white p-3 rounded-lg transition-all duration-300 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Chat Tips -->
                    <div class="mt-3 text-xs text-gray-500">
                        <p>💡 <strong>Tips:</strong> Press Enter to send, Shift+Enter for new line. We typically respond within a few minutes during business hours.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Support Info -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-serif font-bold text-gray-900 mb-4">Other Ways to Reach Us</h2>
            <p class="text-lg text-gray-600">Choose the method that works best for you</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Phone Support</h3>
                <p class="text-gray-600 mb-3">Call us directly for immediate assistance</p>
                <a href="tel:+6281234567890" class="text-blue-600 hover:text-blue-800 font-medium">
                    +62 812-3456-7890
                </a>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Email Support</h3>
                <p class="text-gray-600 mb-3">Send us detailed questions via email</p>
                <a href="mailto:hello@tazeencreative.id" class="text-green-600 hover:text-green-800 font-medium">
                    hello@tazeencreative.id
                </a>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Contact Form</h3>
                <p class="text-gray-600 mb-3">Fill out our detailed contact form</p>
                <a href="{{ route('contact') }}" class="text-purple-600 hover:text-purple-800 font-medium">
                    Contact Form
                </a>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.getElementById('chat-container');
    const chatForm = document.getElementById('chat-form');
    const messageInput = document.getElementById('message-input');

    // Auto scroll to bottom
    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Initial scroll
    scrollToBottom();

    // Handle form submission
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const message = messageInput.value.trim();
        if (!message) return;

        // Disable form while sending
        messageInput.disabled = true;
        const submitBtn = chatForm.querySelector('button[type="submit"]');
        submitBtn.disabled = true;

        fetch('{{ route("chat.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageInput.value = '';
                // Add message to chat immediately for better UX
                addMessageToChat(message, false);
                scrollToBottom();
            } else {
                alert('Failed to send message. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to send message. Please try again.');
        })
        .finally(() => {
            // Re-enable form
            messageInput.disabled = false;
            submitBtn.disabled = false;
            messageInput.focus();
        });
    });

    // Add message to chat UI
    function addMessageToChat(message, isAdmin) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `flex ${isAdmin ? 'justify-end' : 'justify-start'}`;

        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
            hour12: false,
            hour: '2-digit',
            minute: '2-digit'
        });

        messageDiv.innerHTML = `
            <div class="max-w-xs lg:max-w-md">
                <div class="flex items-end space-x-2 ${isAdmin ? 'justify-end' : ''}">
                    ${!isAdmin ? `
                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg px-4 py-2 shadow-sm">
                            <p class="text-sm text-gray-800">${message}</p>
                            <p class="text-xs text-gray-500 mt-1">${timeString}</p>
                        </div>
                    ` : `
                        <div class="bg-gold-500 text-white rounded-lg px-4 py-2 shadow-sm">
                            <p class="text-sm">${message}</p>
                            <p class="text-xs text-gold-100 mt-1">${timeString}</p>
                        </div>
                        <div class="w-8 h-8 bg-gold-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 109.75 9.75A9.75 9.75 0 0012 2.25z"></path>
                            </svg>
                        </div>
                    `}
                </div>
            </div>
        `;

        chatContainer.appendChild(messageDiv);
    }

    // Auto-resize textarea
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
    });
});
</script>
@endsection
