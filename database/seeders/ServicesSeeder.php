<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Basic Package',
                'slug' => 'basic-package',
                'description' => 'Paket dasar untuk kebutuhan fotografi sederhana dengan kualitas profesional. Cocok untuk acara kecil dan intimate.',
                'price_start' => 500000,
                'price_end' => 1000000,
                'duration_hours' => 3,
                'features' => [
                    '50 foto terbaik hasil editing',
                    'Sesi foto 3 jam',
                    'Konsultasi konsep foto',
                    'File digital resolusi tinggi'
                ],
                'package_type' => 'basic',
                'is_popular' => false,
                'is_active' => true
            ],
            [
                'name' => 'Premium Package',
                'slug' => 'premium-package',
                'description' => 'Paket premium dengan layanan lengkap untuk acara spesial Anda. Termasuk pre-wedding dan dokumentasi acara.',
                'price_start' => 1500000,
                'price_end' => 3000000,
                'duration_hours' => 6,
                'features' => [
                    '100 foto terbaik hasil editing',
                    'Sesi foto 6 jam',
                    'Pre-wedding photoshoot',
                    'Album foto premium',
                    'File digital + cetak',
                    'Konsultasi styling'
                ],
                'package_type' => 'premium',
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Luxury Package',
                'slug' => 'luxury-package',
                'description' => 'Paket mewah dengan layanan all-inclusive untuk momen terpenting dalam hidup Anda. Dokumentasi lengkap dari persiapan hingga resepsi.',
                'price_start' => 5000000,
                'price_end' => 10000000,
                'duration_hours' => 12,
                'features' => [
                    '200+ foto terbaik hasil editing',
                    'Full day coverage (12 jam)',
                    'Pre-wedding + engagement shoot',
                    'Album foto luxury + box',
                    'Video highlight 3-5 menit',
                    'Drone photography',
                    'Tim fotografer 2 orang',
                    'Same day edit preview'
                ],
                'package_type' => 'luxury',
                'is_popular' => false,
                'is_active' => true
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
