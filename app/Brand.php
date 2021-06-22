<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    const STATUS = ['Ngừng hoạt động', 'Đang hoạt động'];
    protected $table = "brands";

    protected $fillable = [
        'name', 'hotline', 'owner', 'status'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsBlock($query)
    {
        return $query->where('status', 0);
    }
}
