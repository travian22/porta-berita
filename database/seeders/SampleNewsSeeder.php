<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SampleNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $categories = NewsCategory::all();

        if (!$user || $categories->isEmpty()) {
            $this->command->info('Ensure you have users and categories before running this seeder.');
            return;
        }

        $sampleNews = [
            [
                'title' => 'Presiden Umumkan Kebijakan Ekonomi Baru untuk Mendorong Pertumbuhan',
                'excerpt' => 'Pemerintah meluncurkan serangkaian kebijakan ekonomi baru yang diharapkan dapat mendorong pertumbuhan ekonomi nasional hingga 6% tahun depan.',
                'content' => '<p>Jakarta - Presiden Republik Indonesia hari ini mengumumkan serangkaian kebijakan ekonomi baru yang diharapkan dapat mendorong pertumbuhan ekonomi nasional. Kebijakan ini mencakup reformasi pajak, insentif investasi, dan program pemberdayaan UMKM.</p><p>"Kami berkomitmen untuk menciptakan iklim ekonomi yang kondusif bagi semua lapisan masyarakat," kata Presiden dalam konferensi pers di Istana Negara.</p><p>Kebijakan ini akan mulai diterapkan pada kuartal pertama tahun depan dan diharapkan dapat menciptakan jutaan lapangan kerja baru.</p>',
                'category' => 'Politik',
                'is_featured' => true,
            ],
            [
                'title' => 'Teknologi AI Terbaru Diluncurkan Perusahaan Startup Indonesia',
                'excerpt' => 'Startup teknologi asal Indonesia berhasil mengembangkan sistem AI yang dapat membantu diagnosis medis dengan akurasi 95%.',
                'content' => '<p>Bandung - Sebuah startup teknologi asal Indonesia berhasil mengembangkan sistem kecerdasan buatan (AI) yang revolusioner untuk bidang kesehatan. Sistem ini mampu membantu dokter dalam melakukan diagnosis dengan akurasi hingga 95%.</p><p>CEO perusahaan menjelaskan bahwa teknologi ini telah melalui uji coba selama dua tahun dan akan segera diimplementasikan di beberapa rumah sakit rujukan.</p>',
                'category' => 'Teknologi',
                'is_featured' => true,
            ],
            [
                'title' => 'Timnas Indonesia Lolos ke Semifinal Piala Asia 2024',
                'excerpt' => 'Tim nasional sepak bola Indonesia berhasil mengalahkan Jepang dengan skor 2-1 dan melaju ke babak semifinal Piala Asia 2024.',
                'content' => '<p>Doha - Tim nasional sepak bola Indonesia mencatatkan sejarah dengan berhasil mengalahkan Jepang 2-1 dalam pertandingan perempat final Piala Asia 2024. Kemenangan ini mengantarkan Timnas Indonesia ke babak semifinal untuk pertama kalinya dalam sejarah.</p><p>Gol kemenangan dicetak oleh pemain muda berbakat pada menit ke-89 yang membuat seluruh stadion bergema dengan sorak-sorai suporter Indonesia.</p>',
                'category' => 'Olahraga',
                'is_featured' => true,
            ],
            [
                'title' => 'Rupiah Menguat Terhadap Dolar AS di Tengah Optimisme Ekonomi',
                'excerpt' => 'Nilai tukar rupiah terhadap dolar AS menguat hingga Rp 15.200 per dolar, didorong oleh sentimen positif terhadap ekonomi Indonesia.',
                'content' => '<p>Jakarta - Rupiah hari ini ditutup menguat terhadap dolar Amerika Serikat di level Rp 15.200 per dolar. Penguatan ini didorong oleh sentimen positif investor terhadap prospek ekonomi Indonesia.</p><p>Analis ekonomi memprediksi trend penguatan ini akan berlanjut hingga akhir tahun, didukung oleh stabilitas politik dan pertumbuhan ekonomi yang konsisten.</p>',
                'category' => 'Ekonomi',
                'is_featured' => false,
            ],
            [
                'title' => 'Festival Film Indonesia 2024 Dimulai dengan Antusiasme Tinggi',
                'excerpt' => 'Festival Film Indonesia 2024 resmi dibuka dengan partisipasi lebih dari 200 film dari seluruh Nusantara.',
                'content' => '<p>Jakarta - Festival Film Indonesia (FFI) 2024 resmi dibuka malam ini di Teater Jakarta dengan partisipasi rekor lebih dari 200 film dari seluruh Nusantara. Festival ini akan berlangsung selama satu minggu penuh.</p><p>Ketua panitia menyatakan bahwa kualitas film Indonesia terus meningkat dan mendapat apresiasi positif dari komunitas internasional.</p>',
                'category' => 'Hiburan',
                'is_featured' => false,
            ],
            [
                'title' => 'Program Pendidikan Gratis Diperluas ke Seluruh Provinsi',
                'excerpt' => 'Pemerintah mengumumkan perluasan program pendidikan gratis dari SD hingga SMA ke seluruh provinsi di Indonesia.',
                'content' => '<p>Jakarta - Menteri Pendidikan mengumumkan perluasan program pendidikan gratis yang kini mencakup seluruh provinsi di Indonesia. Program ini akan dimulai pada tahun ajaran baru dan diharapkan dapat meningkatkan angka partisipasi pendidikan.</p><p>Total anggaran yang dialokasikan untuk program ini mencapai Rp 150 triliun dalam lima tahun ke depan.</p>',
                'category' => 'Pendidikan',
                'is_featured' => false,
            ],
        ];

        foreach ($sampleNews as $news) {
            $category = $categories->where('name', $news['category'])->first();
            
            if ($category) {
                News::create([
                    'news_category_id' => $category->id,
                    'user_id' => $user->id,
                    'title' => $news['title'],
                    'slug' => Str::slug($news['title']),
                    'excerpt' => $news['excerpt'],
                    'content' => $news['content'],
                    'status' => 'published',
                    'published_at' => Carbon::now()->subDays(rand(1, 7)),
                    'is_featured' => $news['is_featured'],
                ]);
            }
        }
    }
}
