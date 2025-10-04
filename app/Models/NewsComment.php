<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'news_comments';

    protected $fillable = [
        'news_article_id',
        'parent_id',
        'commenter_name',
        'commenter_email',
        'user_id',
        'content',
        'status',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(News::class, 'news_article_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
