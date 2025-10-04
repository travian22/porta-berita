<x-app-layout>
    <x-slot name="title">Berita Terbaru - Portal Berita</x-slot>

    <!-- Page Header -->
    <section class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-900">Berita Terbaru</h1>
            <p class="text-gray-600 mt-2">Temukan berita terkini dari berbagai kategori</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Content -->
            <div class="lg:w-2/3">
                <!-- Filter & Search -->
                <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
                    <form method="GET" action="{{ route('news.index') }}" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari berita..." 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="flex-1">
                            <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Kategori</option>
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="flex-1">
                            <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Filter
                        </button>
                    </form>
                </div>

                <!-- News List -->
                @if(isset($news) && $news->count() > 0)
                    <div class="space-y-8">
                        @foreach($news as $article)
                            <x-news-card :news="$article" :featured="$loop->first" />
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $news->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada berita</h3>
                        <p class="mt-1 text-sm text-gray-500">Belum ada berita yang dipublikasikan.</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Breaking News -->
                <x-breaking-news />
                
                <!-- Popular News -->
                @if(isset($popularNews) && $popularNews->count() > 0)
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Berita Terpopuler</h3>
                    <div class="space-y-4">
                        @foreach($popularNews as $article)
                            <div class="flex gap-3">
                                @if($article->featured_image_path)
                                    <img src="{{ asset('storage/' . $article->featured_image_path) }}" 
                                         alt="{{ $article->title }}" 
                                         class="w-16 h-16 object-cover rounded">
                                @endif
                                <div class="flex-1">
                                    <h4 class="font-semibold text-sm line-clamp-2 mb-1">
                                        <a href="{{ route('news.show', $article->slug) }}" class="hover:text-blue-600">
                                            {{ $article->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        {{ $article->published_at ? $article->published_at->diffForHumans() : $article->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Categories Widget -->
                <x-category-widget :categories="$categories" />

                <!-- Newsletter -->
                <div class="bg-blue-50 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Newsletter</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Berlangganan untuk mendapatkan berita terbaru di email Anda.
                    </p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Email Anda" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <button type="submit" 
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors text-sm">
                            Berlangganan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>