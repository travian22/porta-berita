@props(['categories'])

<div class="bg-white rounded-lg shadow-sm p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-4">Kategori Populer</h3>
    
    @if($categories && $categories->count() > 0)
        <div class="grid grid-cols-2 gap-3">
            @foreach($categories->take(8) as $category)
                <a href="{{ route('news.category', $category->slug) }}" 
                   class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-colors group">
                    <div class="w-8 h-8 mr-3 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-sm">{{ $category->name }}</h4>
                        <p class="text-xs text-gray-500">{{ $category->news_count ?? 0 }} berita</p>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-sm">Belum ada kategori tersedia.</p>
    @endif
</div>