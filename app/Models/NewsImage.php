<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsImage extends Model
{
    use HasFactory;

    protected $table = 'news_images';

    protected $fillable = [
        'news_article_id',
        'image_path',
        'caption',
        'order_column',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(News::class, 'news_article_id');
    }
}
