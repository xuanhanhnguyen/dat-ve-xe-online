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

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsBlock($query)
    {
        return $query->where('status', '<>', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
