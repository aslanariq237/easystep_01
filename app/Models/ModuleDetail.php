<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleDetail extends Model
{
    protected $table = 'module_detail';
    protected $primaryKey = 'id';
    protected $fillable = [        
        'module_id',
        'content',
        'has_image',
        'has_video',
        'image',
        'video'
    ];
}
