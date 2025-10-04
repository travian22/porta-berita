<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredNews = News::published()
            ->featured()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(5)
            ->get();

        $latestNews = News::published()
            ->with(['category', 'author'])
            ->latest('published_at')
            ->take(10)
            ->get();

        $popularCategories = NewsCategory::withCount(['news' => function ($query) {
            $query->published();
        }])
            ->orderBy('news_count', 'desc')
            ->take(6)
            ->get();

        return view('public.home', compact('featuredNews', 'latestNews', 'popularCategories'));
    }
}
