<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Car;
use App\Place;
use App\Post;

class SearchController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {

        $places = $this->places();

        $_url = "";
        foreach (request()->all() as $key => $item) {
            $_url .= '&' . $key . '=' . $item;
        }
        $_url = '?' . substr($_url, 1);

        $cars = Car::with([])->where([
            ['station_a', request()->station_a],
            ['station_b', request()->station_b]
        ])->orWhere([
            ['station_a', request()->station_b],
            ['station_b', request()->station_a]
        ]);

        if (isset(request()->time_start)) {
            $cars = $cars->where([
                ['time_start_a', 'like', '%' . request()->time_start . '%'],
                ['station_a', request()->station_a],
            ])->orWhere([
                ['time_start_b', 'like', '%' . request()->time_start . '%'],
                ['station_b', request()->station_b],
            ])->orWhere([
                ['time_start_b', 'like', '%' . request()->time_start . '%'],
                ['station_b', request()->station_a],
            ]);
        }

        if (isset(request()->brand_id)) {
            $cars = $cars->where('brand_id', request()->brand_id);
        }

        if (isset(request()->type_car)) {
            $cars = $cars->where('type_car', 'like', '%' . request()->type_car . '%');
        }

        $cars = $cars->paginate(10)->setPath(request()->path() . $_url);

        $times = array_unique(array_merge(array_column(Car::isActive()->get()->toArray(), 'time_start_a'), array_column(Car::isActive()->get()->toArray(), 'time_start_b')));
        $type_cars = array_unique(array_column($cars->toArray()['data'], 'type_car'));

        $brands = array_unique(array_column($cars->toArray()['data'], 'brand_id'));
        $brands = Brand::with([])->whereIn('id', $brands)->get();
        $posts = Post::isActive()->get();

        return view('search', compact('places', 'cars', 'times', 'brands', 'type_cars', 'posts'));
    }

    public function places()
    {
        $data = Place::with('parent')->get();
        $group = [];

        foreach (Place::GROUP as $key => $item) {
            $group[$key] = [];
        }

        foreach ($data as $item) {
            $group[$item->group][] = $item;
        }
        return $group;

    }
}
