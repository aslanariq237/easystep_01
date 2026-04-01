<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    protected $table = 'forum_posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'user_id',  
        'like'      
    ];

    public function comments()
    {
        return $this->hasMany(ForumComment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toogleLike()
    {
        $this->like = $this->like + 1;
        $this->save();

        return true;
    }

    public function unlike()
    {
        if ($this->like > 0) {
            $this->like = $this->like - 1;
            $this->save();
        }
        return true;
    }
}
