<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NewsTag extends Model
{
    use HasFactory;

    protected $table = 'news_tags';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function news(): BelongsToMany
    {
        return $this->belongsToMany(News::class, 'news_article_tag', 'news_tag_id', 'news_article_id');
    }
}
