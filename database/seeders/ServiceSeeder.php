<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Basic Package',
                'slug' => 'basic-package',
                'description' => 'Paket dasar untuk kebutuhan fotografi sederhana dengan kualitas profesional',
                'price_start' => 500000,
                'price_end' => 1000000,
                'duration_hours' => 3,
                'features' => [
                    '2-3 jam sesi pemotretan',
                    '20-30 foto hasil edit',
                    'Galeri online',
                    'Konsultasi gratis',
                    'Revisi minor'
                ],
                'package_type' => 'basic',
                'is_popular' => false
            ],
            [
                'name' => 'Premium Package',
                'slug' => 'premium-package',
                'description' => 'Paket premium dengan durasi lebih panjang dan hasil foto lebih banyak',
                'price_start' => 1000000,
                'price_end' => 2000000,
                'duration_hours' => 6,
                'features' => [
                    '4-6 jam sesi pemotretan',
                    '50-80 foto hasil edit',
                    'Foto cetak included',
                    'Same day preview',
                    'Galeri online premium',
                    'Konsultasi unlimited'
                ],
                'package_type' => 'premium',
                'is_popular' => true
            ],
            [
                'name' => 'Platinum Package',
                'slug' => 'platinum-package',
                'description' => 'Paket terlengkap dengan layanan premium dan hasil maksimal',
                'price_start' => 2000000,
                'price_end' => null,
                'duration_hours' => 8,
                'features' => [
                    'Full day shooting',
                    '100+ foto hasil edit',
                    'Desain album eksklusif',
                    'Video highlight',
                    'Foto cetak premium',
                    'USB flashdisk custom',
                    'Konsultasi & revisi unlimited'
                ],
                'package_type' => 'platinum',
                'is_popular' => false
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
