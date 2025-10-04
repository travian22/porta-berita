<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsTag;
use Illuminate\Support\Str;

class NewsTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            // Politik
            'Pemilu', 'DPR', 'Presiden', 'Kebijakan', 'Pemerintah', 'Partai Politik',
            
            // Ekonomi
            'Inflasi', 'Rupiah', 'Investasi', 'UMKM', 'Pasar Modal', 'Bank Indonesia', 
            'Ekspor', 'Impor', 'APBN', 'Pajak',
            
            // Teknologi
            'AI', 'Blockchain', 'Startup', 'E-commerce', 'Fintech', 'IoT', 
            'Cloud Computing', 'Cybersecurity', 'Mobile App', 'Big Data',
            
            // Olahraga
            'Sepak Bola', 'Badminton', 'Basket', 'Olimpiade', 'Asian Games', 
            'Liga Indonesia', 'Timnas', 'Prestasi', 'Atlet',
            
            // Hiburan
            'Film', 'Musik', 'Konser', 'Drama', 'Artis', 'K-Pop', 
            'Hollywood', 'Festival', 'Awards', 'Streaming',
            
            // Pendidikan
            'Universitas', 'Sekolah', 'Beasiswa', 'Kurikulum', 'Guru', 
            'Mahasiswa', 'Penelitian', 'Literasi', 'UTBK',
            
            // Kesehatan
            'COVID-19', 'Vaksin', 'Rumah Sakit', 'Diet', 'Fitness', 
            'Mental Health', 'Obat', 'Dokter', 'Gizi',
            
            // Lingkungan
            'Perubahan Iklim', 'Polusi', 'Daur Ulang', 'Energi Terbarukan', 
            'Hutan', 'Laut', 'Biodiversitas', 'Sampah',
            
            // Umum
            'Breaking News', 'Trending', 'Viral', 'Update', 'Terbaru', 
            'Investigasi', 'Eksklusif', 'Live', 'Special Report'
        ];

        foreach ($tags as $tag) {
            NewsTag::create([
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
}
