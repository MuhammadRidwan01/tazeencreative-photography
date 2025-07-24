<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Live Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="chat-container" class="h-96 overflow-y-auto border rounded p-4 mb-4 bg-gray-50">
                        @foreach($messages as $message)
                            <div class="mb-4 {{ $message->is_admin ? 'text-right' : 'text-left' }}">
                                <div class="inline-block max-w-xs lg:max-w-md px-4 py-2 rounded {{ $message->is_admin ? 'bg-blue-500 text-white' : 'bg-white border' }}">
                                    <p class="text-sm">{{ $message->message }}</p>
                                    @if($message->file_path)
                                        <a href="{{ Storage::url($message->file_path) }}" target="_blank" class="text-xs underline">
                                            Lihat File
                                        </a>
                                    @endif
                                    <p class="text-xs mt-1 {{ $message->is_admin ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ $message->created_at->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <form id="chat-form" class="flex space-x-2">
                        @csrf
                        <input type="text" id="message-input" placeholder="Ketik pesan..." class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value.trim();
            
            if (!message) return;
            
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
                    location.reload(); // Simple reload for now
                }
            });
        });
    </script>
</x-app-layout>
