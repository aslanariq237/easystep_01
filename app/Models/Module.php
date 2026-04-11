<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProgressActivities;

class Module extends Model
{
    protected $table = 'module';
    protected $fillable = [
        'title',
        'slug',
        'type',        
        'description',        
        'image',
        'uploaded_by'
    ];  
    
    public function sections(){
        return $this->hasMany(ModuleDetail::class);
    }    

    public function getProgressForUser($userId)
    {
        $totalSubbab = $this->sections()->count();

        if ($totalSubbab === 0) return 0;

        $accessedCount = ProgressActivities::where('user_id', $userId)
                            ->where('module_id', $this->id)
                            ->count();

        $progress = ($accessedCount / $totalSubbab) * 100;

        return round($progress);
    }
}
