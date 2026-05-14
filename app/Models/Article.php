<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image_url',
        'created_by',
        'uploaded_by',
    ];
}
