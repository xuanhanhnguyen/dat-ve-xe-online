<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE = ['admin' => 'Quản trị viên', 'member' => "Thành viên"];

    const STATUS = ['Khóa', 'Hoạt động'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeIsBlock($query)
    {
        return $query->where('status', 0);
    }

    public function scopeIsMember($query)
    {
        return $query->where('role', 'member');
    }

    public function scopeIsAdmin($query)
    {
        return $query->where('role', 'admin');
    }
}
