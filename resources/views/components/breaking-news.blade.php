<div class="bg-white rounded-lg shadow-sm p-6 mb-8">
    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd" />
        </svg>
        Breaking News
    </h3>
    
    @if(isset($breakingNews) && $breakingNews->count() > 0)
        <div class="space-y-3">
            @foreach($breakingNews->take(3) as $news)
                <div class="border-l-4 border-red-600 pl-4 py-2">
                    <h4 class="font-semibold text-sm text-gray-900 mb-1">
                        <a href="{{ route('news.show', $news->slug) }}" class="hover:text-red-600 transition-colors">
                            {{ $news->title }}
                        </a>
                    </h4>
                    <p class="text-xs text-gray-500">
                        {{ $news->published_at ? $news->published_at->diffForHumans() : $news->created_at->diffForHumans() }}
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500 text-sm">Tidak ada breaking news saat ini.</p>
    @endif
</div>