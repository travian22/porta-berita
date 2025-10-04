<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsAttachment extends Model
{
    use HasFactory;

    protected $table = 'news_attachments';

    protected $fillable = [
        'news_article_id',
        'display_name',
        'file_path',
        'file_type',
        'file_size',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(News::class, 'news_article_id');
    }
}
