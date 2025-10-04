<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News\NewsCategory;
use App\Models\News\News;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::withCount(['news' => function ($query) {
            $query->published();
        }])->get();

    return view('public.categories.index', compact('categories'));
    }

    public function show(NewsCategory $category)
    {
        $news = News::published()
            ->where('news_category_id', $category->id)
            ->with(['category', 'author'])
            ->latest('published_at')
            ->paginate(12);

    return view('public.categories.show', compact('category', 'news'));
    }
}