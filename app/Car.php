<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    const STATUS = ['Hết chỗ', 'Còn chỗ', 'Tạm nghỉ', 'Dừng chạy'];

    protected $table = "cars";

    protected $fillable = [
        'brand_id', 'image', 'type_car', 'number_seats', 'station_a', 'station_b', 'time_start_a', 'time_start_b',
        'total_time', 'price', 'status'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function start()
    {
        return $this->belongsTo(Place::class, 'station_a', 'id');
    }

    public function end()
    {
        return $this->belongsTo(Place::class, 'station_b', 'id');
    }

    //Relationship to tag
    public function utilities()
    {
        return $this->belongsToMany(Utility::class, 'car_utility', 'car_id');
    }
}
