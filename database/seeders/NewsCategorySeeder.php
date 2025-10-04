<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Politik',
                'description' => 'Berita seputar politik nasional dan internasional'
            ],
            [
                'name' => 'Ekonomi',
                'description' => 'Berita ekonomi, bisnis, dan keuangan'
            ],
            [
                'name' => 'Teknologi',
                'description' => 'Berita teknologi, inovasi, dan digital'
            ],
            [
                'name' => 'Olahraga',
                'description' => 'Berita olahraga nasional dan internasional'
            ],
            [
                'name' => 'Hiburan',
                'description' => 'Berita hiburan, selebriti, dan entertainment'
            ],
            [
                'name' => 'Pendidikan',
                'description' => 'Berita pendidikan dan akademik'
            ],
            [
                'name' => 'Kesehatan',
                'description' => 'Berita kesehatan, medis, dan gaya hidup sehat'
            ],
            [
                'name' => 'Lingkungan',
                'description' => 'Berita lingkungan hidup dan konservasi'
            ],
            [
                'name' => 'Hukum',
                'description' => 'Berita hukum, kriminal, dan keadilan'
            ],
            [
                'name' => 'Internasional',
                'description' => 'Berita internasional dan hubungan luar negeri'
            ]
        ];

        foreach ($categories as $category) {
            NewsCategory::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description']
            ]);
        }
    }
}
