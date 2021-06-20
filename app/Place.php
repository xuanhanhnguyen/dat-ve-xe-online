<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    const STATUS = ['Ẩn', 'Hiển thị'];
    const GROUP = ['Tỉnh', 'Thành phố', 'Quận - Huyện - Thị xã', 'Phường - Xã', 'Bến xe', 'Khác'];

    protected $table = "places";

    protected $fillable = [
        'name', 'parent_id', 'group'
    ];

    public function parent()
    {
        return $this->belongsTo(Place::class, 'id', 'parent_id');
    }

}
