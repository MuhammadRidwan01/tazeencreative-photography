<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'Pre-Wedding Rina & Andi',
                'image_path' => 'portfolio/portfolio-1.png',
                'thumbnail_path' => 'portfolio/portfolio-1.png',
                'description' => 'Sesi pre-wedding romantis di tengah alam terbuka.',
                'category_id' => 1,
                'is_featured' => false,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Foto Keluarga Ibu Dini',
                'image_path' => 'portfolio/portfolio-2.png',
                'thumbnail_path' => 'portfolio/portfolio-2.png',
                'description' => 'Potret keluarga yang hangat dan natural.',
                'category_id' => 2,
                'is_featured' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apa sihh',
                'image_path' => 'portfolio/portfolio-3.png',
                'thumbnail_path' => 'portfolio/portfolio-3.png',
                'description' => 'Potret keluarga yang hangat dan natural.',
                'category_id' => 3,
                'is_featured' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apa sihh',
                'image_path' => 'portfolio/portfolio-4.png',
                'thumbnail_path' => 'portfolio/portfolio-4.png',
                'description' => 'Potret keluarga yang hangat dan natural.',
                'category_id' => 4,
                'is_featured' => true,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apa sihh',
                'image_path' => 'portfolio/portfolio-5.png',
                'thumbnail_path' => 'portfolio/portfolio-5.png',
                'description' => 'Potret keluarga yang hangat dan natural.',
                'category_id' => 1,
                'is_featured' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apa sihh',
                'image_path' => 'portfolio/portfolio-6.png',
                'thumbnail_path' => 'portfolio/portfolio-6.png',
                'description' => 'Potret keluarga yang hangat dan natural.',
                'category_id' => 2,
                'is_featured' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Apa sihh',
                'image_path' => 'portfolio/portfolio-7.png',
                'thumbnail_path' => 'portfolio/portfolio-7.png',
                'description' => 'Potret keluarga yang hangat dan natural.',
                'category_id' => 3,
                'is_featured' => true,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}
