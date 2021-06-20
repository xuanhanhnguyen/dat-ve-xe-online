<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    const STATUS = ['Ẩn', 'Hiển thị'];

    protected $table = "utilities";

    protected $fillable = [
        'image', 'name', 'description', 'status'
    ];

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsBlock($query)
    {
        return $query->where('status', 0);
    }

    public function cars()
    {
        return $this->belongsToMany(Car::class);
    }
}
