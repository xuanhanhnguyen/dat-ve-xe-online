<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const STATUS = ['Ẩn', 'Hiển thị'];
    protected $table = 'posts';

    protected $fillable = [
        'name', 'description', 'content', 'author', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
