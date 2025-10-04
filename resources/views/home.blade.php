<x-app-layout>
    <x-slot name="title">Portal Berita - Berita Terkini Indonesia</x-slot>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Berita Terkini Indonesia
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    Dapatkan informasi terbaru, akurat, dan terpercaya dari berbagai daerah di Indonesia
                </p>
                <a href="{{ route('news.index') }}" 
                   class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Breaking News Ticker -->
    <section class="bg-red-600 text-white py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <span class="bg-white text-red-600 px-3 py-1 rounded text-sm font-bold mr-4">BREAKING</span>
                <div class="flex-1 overflow-hidden">
                    <div class="animate-scroll whitespace-nowrap">
                        <span class="mr-8">• Berita terbaru: Update COVID-19 hari ini</span>
                        <span class="mr-8">• Ekonomi: Rupiah menguat terhadap dolar AS</span>
                        <span class="mr-8">• Olahraga: Timnas Indonesia lolos ke semifinal</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured News -->
    @if(isset($featuredNews) && $featuredNews->count() > 0)
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Berita Utama</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Featured News -->
                <div class="lg:col-span-2">
                    @if($featuredNews->first())
                        <x-news-card :news="$featuredNews->first()" :featured="true" />
                    @endif
                </div>
                
                <!-- Side Featured News -->
                <div class="space-y-6">
                    @foreach($featuredNews->skip(1)->take(3) as $news)
                        <x-news-card :news="$news" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News -->
    @if(isset($latestNews) && $latestNews->count() > 0)
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Berita Terbaru</h2>
                <a href="{{ route('news.index') }}" 
                   class="text-blue-600 hover:text-blue-800 font-semibold">
                    Lihat Semua →
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latestNews as $news)
                    <x-news-card :news="$news" />
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Categories Section -->
    @if(isset($categories) && $categories->count() > 0)
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Kategori Berita</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('news.category', $category->slug) }}" 
                       class="bg-gray-100 hover:bg-blue-100 rounded-lg p-6 text-center transition-colors group">
                        <div class="w-12 h-12 mx-auto mb-3 bg-blue-600 rounded-full flex items-center justify-center group-hover:bg-blue-700 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                            {{ $category->name }}
                        </h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Newsletter Section -->
    <section class="py-12 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Berlangganan Newsletter</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                Dapatkan berita terbaru langsung di email Anda. Kami akan mengirimkan update harian dengan berita pilihan.
            </p>
            
            <form class="max-w-md mx-auto flex">
                <input type="email" placeholder="Masukkan email Anda" 
                       class="flex-1 px-4 py-3 rounded-l-lg border-0 focus:ring-2 focus:ring-blue-300 focus:outline-none">
                <button type="submit" 
                        class="px-6 py-3 bg-white text-blue-600 rounded-r-lg font-semibold hover:bg-gray-100 transition-colors">
                    Berlangganan
                </button>
            </form>
        </div>
    </section>

</x-app-layout>

<style>
@keyframes scroll {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}

.animate-scroll {
    animation: scroll 30s linear infinite;
}
</style>