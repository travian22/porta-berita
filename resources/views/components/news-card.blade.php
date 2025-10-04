@props(['news', 'featured' => false])

<article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 {{ $featured ? 'md:flex' : '' }}">
    @if($news->featured_image_path)
        <div class="{{ $featured ? 'md:w-1/2' : '' }}">
            <img src="{{ asset('storage/' . $news->featured_image_path) }}" 
                 alt="{{ $news->title }}" 
                 class="w-full {{ $featured ? 'h-64 md:h-full' : 'h-48' }} object-cover">
        </div>
    @endif
    
    <div class="p-6 {{ $featured ? 'md:w-1/2' : '' }}">
        <!-- Category & Date -->
        <div class="flex items-center justify-between mb-3">
            @if($news->category)
                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-semibold">
                    {{ $news->category->name }}
                </span>
            @endif
            <time class="text-gray-500 text-sm">
                {{ $news->published_at ? $news->published_at->diffForHumans() : $news->created_at->diffForHumans() }}
            </time>
        </div>
        
        <!-- Title -->
        <h3 class="{{ $featured ? 'text-2xl' : 'text-lg' }} font-bold text-gray-900 mb-3 line-clamp-2">
            <a href="{{ route('news.show', $news->slug) }}" class="hover:text-blue-600 transition-colors">
                {{ $news->title }}
            </a>
        </h3>
        
        <!-- Excerpt -->
        @if($news->excerpt)
            <p class="text-gray-600 mb-4 {{ $featured ? 'text-base' : 'text-sm' }} line-clamp-3">
                {{ $news->excerpt }}
            </p>
        @endif
        
        <!-- Meta Info -->
        <div class="flex items-center justify-between">
            @if($news->author)
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                        <span class="text-xs font-semibold text-gray-600">
                            {{ substr($news->author->name, 0, 1) }}
                        </span>
                    </div>
                    <span class="text-sm text-gray-600">{{ $news->author->name }}</span>
                </div>
            @endif
            
            <a href="{{ route('news.show', $news->slug) }}" 
               class="text-blue-600 hover:text-blue-800 text-sm font-semibold transition-colors">
                Baca Selengkapnya →
            </a>
        </div>
    </div>
</article>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>