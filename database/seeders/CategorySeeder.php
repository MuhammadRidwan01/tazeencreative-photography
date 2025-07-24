<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Wedding & Pre-Wedding',
                'slug' => 'wedding-pre-wedding',
                'description' => 'Dokumentasi pernikahan dan sesi pre-wedding yang romantis dan berkesan'
            ],
            [
                'name' => 'Portrait & Family',
                'slug' => 'portrait-family',
                'description' => 'Potret individu, keluarga, dan sesi maternity yang hangat dan natural'
            ],
            [
                'name' => 'Product Photography',
                'slug' => 'product-photography',
                'description' => 'Fotografi produk UMKM, makanan, dan fashion dengan kualitas profesional'
            ],
            [
                'name' => 'Event Documentation',
                'slug' => 'event-documentation',
                'description' => 'Dokumentasi acara corporate, ulang tahun, dan momen spesial lainnya'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
