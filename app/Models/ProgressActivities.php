<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressActivities extends Model
{
    protected $table = 'progress_activities';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'module_id',
        'accessed_at'
    ];
}
