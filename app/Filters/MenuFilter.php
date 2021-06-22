<?php


namespace App\Filters;


use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;


class MenuFilter implements FilterInterface
{

    public function transform($item, Builder $builder)
    {

        if (isset($item['permission']) && Auth::user()->role != $item['permission']) {
            return false;
        }

        return $item;
    }
}