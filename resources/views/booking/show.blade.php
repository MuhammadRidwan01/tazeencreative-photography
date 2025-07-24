<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informasi Booking</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Paket</dt>
                                    <dd class="text-sm text-gray-900">{{ $booking->service->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tanggal & Waktu</dt>
                                    <dd class="text-sm text-gray-900">{{ $booking->booking_date->format('d M Y') }} - {{ $booking->booking_time->format('H:i') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Lokasi</dt>
                                    <dd class="text-sm text-gray-900">{{ $booking->location }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Budget</dt>
                                    <dd class="text-sm text-gray-900">Rp {{ number_format($booking->budget_min, 0, ',', '.') }} - Rp {{ number_format($booking->budget_max, 0, ',', '.') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="text-sm">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $booking->status_badge }}">
                                            {{ $booking->status_text }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Informasi Kontak</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                                    <dd class="text-sm text-gray-900">{{ $booking->client_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="text-sm text-gray-900">{{ $booking->client_email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Telepon</dt>
                                    <dd class="text-sm text-gray-900">{{ $booking->client_phone }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    @if($booking->requirements)
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-2">Detail Requirements</h3>
                            <p class="text-sm text-gray-700 bg-gray-50 p-4 rounded">{{ $booking->requirements }}</p>
                        </div>
                    @endif

                    @if($booking->admin_notes)
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-2">Catatan Admin</h3>
                            <p class="text-sm text-gray-700 bg-blue-50 p-4 rounded">{{ $booking->admin_notes }}</p>
                        </div>
                    @endif

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('booking.history') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                            Kembali
                        </a>
                        
                        @if($booking->status === 'pending')
                            <form method="POST" action="{{ route('booking.cancel', $booking) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Yakin ingin membatalkan booking?')">
                                    Batalkan Booking
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
