<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with(['category', 'author'])
            ->where('status', 'published');

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('news_category_id', $request->category);
        }

        // Sorting
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'popular':
                // Assuming you have a views column or similar
                $query->orderBy('created_at', 'desc');
                break;
            default: // latest
                $query->orderBy('published_at', 'desc');
                break;
        }

        $news = $query->paginate(9);

        // Get breaking news (latest 3 news)
        $breakingNews = News::with(['category', 'author'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get popular news for sidebar
        $popularNews = News::with(['category', 'author'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get categories for filter and sidebar
        $categories = NewsCategory::withCount('news')
            ->orderBy('name')
            ->get();

        return view('news.index', compact('news', 'popularNews', 'categories', 'breakingNews'));
    }

    public function show($slug)
    {
        $news = News::with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Get related news (same category, exclude current)
        $relatedNews = News::with(['category', 'author'])
            ->where('status', 'published')
            ->where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->firstOrFail();
        
        $news = News::with(['category', 'author'])
            ->where('status', 'published')
            ->where('news_category_id', $category->id)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        // Get popular news for sidebar
        $popularNews = News::with(['category', 'author'])
            ->where('status', 'published')
            ->where('news_category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get all categories for sidebar
        $categories = NewsCategory::withCount('news')
            ->orderBy('name')
            ->get();

        return view('news.index', compact('news', 'popularNews', 'categories', 'category'));
    }
}