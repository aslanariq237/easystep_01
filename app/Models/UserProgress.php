<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $table = 'user_progress';
    protected $fillable = [
        'user_id',
        'module_id',
        'type',        
        'last_accessed_at'
    ];

    protected $casts = [        
        'last_access_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id', 'id');
    }

    public function getCompletedModuleAttribute()
    {
        return count($this->complete_module_ids ?? []);
    }
}
