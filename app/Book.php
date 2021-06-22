<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    const STATUS = ['Hủy', 'Mới', 'Đã xác nhận', "Đã thanh toán"];

    protected $table = "books";

    protected $fillable = ['car_id', 'name', 'phone', 'a_to_b', 'price', 'quantity', 'time_start', 'amount_total', 'status'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
