<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->with(['category', 'author']);

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%");
            });
        }

        $news = $query->latest('published_at')->paginate(12);
        $categories = NewsCategory::all();

        return view('public.news.index', compact('news', 'categories'));
    }

    public function show(News $news)
    {
        if ($news->status !== 'published') {
            abort(404);
        }

        $relatedNews = News::published()
            ->where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('public.news.show', compact('news', 'relatedNews'));
    }
}
