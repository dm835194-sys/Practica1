<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Permitimos la asignación masiva para el contenido y las llaves foráneas
    protected $fillable = [
        'content', 
        'post_id', 
        'user_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}