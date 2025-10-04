<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured news (is_featured = true and published)
        $featuredNews = News::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        // Get latest news (published, not featured)
        $latestNews = News::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_featured', false)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // Get all categories for navigation
        $categories = NewsCategory::withCount('news')
            ->orderBy('name')
            ->take(6)
            ->get();

        return view('home', compact('featuredNews', 'latestNews', 'categories'));
    }
}