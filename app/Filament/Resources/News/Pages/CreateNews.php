<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Set user_id to current authenticated user
        $data['user_id'] = Auth::id();

        // Auto-generate unique slug from title
        if (!empty($data['title'])) {
            $data['slug'] = $this->generateUniqueSlug($data['title']);
        }

        // Ensure excerpt is present (fallback to first 160 chars of content)
        if (empty($data['excerpt']) && !empty($data['content'])) {
            $plain = strip_tags($data['content']);
            $data['excerpt'] = mb_substr($plain, 0, 160);
        }

        return $data;
    }

    private function generateUniqueSlug(string $title): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists and increment counter if needed
        while (DB::table('news_articles')->where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
