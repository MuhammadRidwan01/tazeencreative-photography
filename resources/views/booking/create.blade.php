<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Booking Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('booking.store') }}" class="space-y-6">
                        @csrf

                        <!-- Service Selection -->
                        <div>
                            <label for="service_id" class="block text-sm font-medium text-gray-700">Pilih Paket</label>
                            <select name="service_id" id="service_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih Paket Photoshoot</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ $selectedService && $selectedService->id == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }} - {{ $service->formatted_price }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Client Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="client_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="client_name" id="client_name" value="{{ old('client_name', auth()->user()->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('client_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="client_email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="client_email" id="client_email" value="{{ old('client_email', auth()->user()->email) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('client_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="client_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="tel" name="client_phone" id="client_phone" value="{{ old('client_phone') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('client_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Booking Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="booking_date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                                <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('booking_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="booking_time" class="block text-sm font-medium text-gray-700">Waktu</label>
                                <select name="booking_time" id="booking_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Pilih Waktu</option>
                                    <option value="08:00">08:00 - Pagi</option>
                                    <option value="10:00">10:00 - Pagi</option>
                                    <option value="13:00">13:00 - Siang</option>
                                    <option value="15:00">15:00 - Sore</option>
                                    <option value="17:00">17:00 - Sore</option>
                                </select>
                                @error('booking_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                            <input type="text" name="location" id="location" value="{{ old('location') }}" placeholder="Contoh: Jakarta Selatan, Studio, Outdoor" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Budget Range -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="budget_min" class="block text-sm font-medium text-gray-700">Budget Minimum (Rp)</label>
                                <input type="number" name="budget_min" id="budget_min" value="{{ old('budget_min') }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('budget_min')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="budget_max" class="block text-sm font-medium text-gray-700">Budget Maximum (Rp)</label>
                                <input type="number" name="budget_max" id="budget_max" value="{{ old('budget_max') }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('budget_max')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="requirements" class="block text-sm font-medium text-gray-700">Detail Requirements</label>
                            <textarea name="requirements" id="requirements" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Jelaskan detail kebutuhan photoshoot Anda...">{{ old('requirements') }}</textarea>
                            @error('requirements')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('services.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-4">
                                Kembali
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buat Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
