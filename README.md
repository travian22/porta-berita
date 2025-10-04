# 📰 Portal Berita

Portal berita modern yang dibangun menggunakan Laravel dan Filament Admin Panel. Aplikasi ini menyediakan platform lengkap untuk mengelola dan menampilkan berita dengan antarmuka yang responsif dan user-friendly.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-FFAA00?style=for-the-badge&logo=filament&logoColor=white)

## ✨ Fitur Utama

### 📱 Frontend (Public Site)
- **Homepage** dengan berita unggulan dan terbaru
- **Halaman daftar berita** dengan pencarian dan filter
- **Detail berita** dengan gambar dan konten lengkap
- **Kategori berita** yang terorganisir
- **Design responsif** untuk semua perangkat
- **Navigasi yang intuitif** dengan navbar dan footer

### 🛠️ Backend (Admin Panel)
- **Dashboard admin** dengan statistik
- **CRUD berita** lengkap dengan upload gambar
- **Manajemen kategori** berita
- **Manajemen tag** untuk artikel
- **Auto-generate slug** dari judul
- **Status publikasi** (draft/published)
- **Fitur featured** untuk berita unggulan

## 🚀 Teknologi yang Digunakan

- **Backend:** Laravel 11
- **Admin Panel:** Filament v3
- **Frontend:** Blade Templates + Tailwind CSS
- **Database:** SQLite (dapat diganti dengan MySQL/PostgreSQL)
- **Storage:** Laravel Storage dengan disk public
- **Build Tools:** Vite
- **PHP Version:** 8.2+

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL
- Web Server (Apache/Nginx) atau Laravel Development Server

## 🔧 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd portal-berita
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create database file (untuk SQLite)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed --class=NewsCategorySeeder
php artisan db:seed --class=SampleNewsSeeder
```

### 5. Storage Setup
```bash
# Create storage symlink
php artisan storage:link
```

### 6. Build Assets
```bash
# Build frontend assets
npm run build

# Atau untuk development
npm run dev
```

### 7. Start Development Server
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

## 🗂️ Struktur Database

### News Articles (`news_articles`)
- `id` - Primary key
- `news_category_id` - Foreign key ke categories
- `user_id` - Foreign key ke users (author)
- `title` - Judul berita
- `slug` - URL-friendly slug
- `excerpt` - Ringkasan berita
- `content` - Konten lengkap berita
- `featured_image_path` - Path gambar utama
- `status` - Status publikasi (draft/published)
- `is_featured` - Boolean untuk berita unggulan
- `published_at` - Tanggal publikasi

### Categories (`news_categories`)
- `id` - Primary key
- `name` - Nama kategori
- `slug` - URL-friendly slug
- `description` - Deskripsi kategori

### Tags (`news_tags`)
- `id` - Primary key
- `name` - Nama tag
- `slug` - URL-friendly slug

## 🎨 Antarmuka

### Frontend Routes
- `/` - Homepage dengan berita unggulan
- `/berita` - Daftar semua berita
- `/berita/{slug}` - Detail berita
- `/kategori/{slug}` - Berita berdasarkan kategori

### Admin Panel
- `/admin` - Dashboard admin
- `/admin/news` - Manajemen berita
- `/admin/categories` - Manajemen kategori
- `/admin/tags` - Manajemen tag

## 📸 Upload Gambar

Gambar berita disimpan di:
- **Storage:** `storage/app/public/news/featured/`
- **Public URL:** `http://domain.com/storage/news/featured/filename.png`
- **Database:** Menyimpan path relatif `news/featured/filename.png`

## 🛡️ Keamanan

- CSRF Protection aktif
- Mass assignment protection
- File upload validation
- XSS protection melalui Blade templates
- SQL injection protection melalui Eloquent ORM

## 🔧 Konfigurasi

### File Upload
Konfigurasi upload gambar dapat disesuaikan di:
```php
// app/Filament/Resources/News/Schemas/NewsForm.php
FileUpload::make('featured_image_path')
    ->disk('public')
    ->directory('news/featured')
    ->maxSize(10240) // 10MB
    ->acceptedFileTypes(['image/jpeg', 'image/png'])
```

### Storage Disk
Konfigurasi storage disk di `config/filesystems.php`:
```php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
    'url' => env('APP_URL').'/storage',
    'visibility' => 'public',
]
```

## 🧪 Testing

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=NewsTest
```

## 📝 Contributing

1. Fork repository
2. Buat feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buat Pull Request

## 📄 License

Proyek ini menggunakan [MIT License](LICENSE).

## 🤝 Support

Jika Anda menemukan bug atau memiliki saran, silakan buat [issue](../../issues) atau hubungi tim development.

---

<p align="center">
Dibuat dengan ❤️ menggunakan Laravel & Filament
</p>
