<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * The news model
 */
class News extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'news';

    /**
     * @var array
     */
    protected $fillable = [
        "title",
        "snippet",
        "document_type",
        "short",
        "source",
        "category",
        "subcategory",
        "author",
        "link",
        "published_at"
    ];
}
