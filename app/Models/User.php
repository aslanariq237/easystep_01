<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // ini tuh untuk melihat progress dari setiap parent ataupun children
    public function parentProgress()
    {
        return $this->hasOne(UserProgress::class, 'user_id', 'id')
            ->where('type', 'parent');
    }

    public function childrenProgress()
    {
        return $this->hasOne(UserProgress::class, 'user_id', 'id')
            ->where('type', 'children');
    }

    public function getParentProgressAttribute()
    {
        $accessedCount = ModuleAccessHistory::where('user_id', $this->id)
                            ->where('type', 'parent')
                            ->distinct('module_id')
                            ->count('module_id');

        $totalModules = Module::where('type', 'parent')->count();

        if($totalModules === 0) return 0;
        return round(($accessedCount / $totalModules) * 100);
    }

    public function getChildrenProgressAttribute()
    {
        $accessedCount = ModuleAccessHistory::where('user_id', $this->id)
                            ->where('type', 'children')
                            ->distinct('module_id')
                            ->count('module_id');

        $totalModules = Module::where('type', 'children')->count();

        if($totalModules === 0) return 0;
        return round(($accessedCount / $totalModules) * 100);
    }
}
