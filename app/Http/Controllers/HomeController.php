<?php

namespace App\Http\Controllers;

use App\Book;
use App\Car;
use App\Place;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $places = $this->places();
        $posts = Post::isActive()->get();
        return view('home', compact('places', 'posts'));
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

    public function book(Request $request)
    {
        try {
            $data = collect($request->all())->merge([
                'price' => Car::find($request->car_id)->price,
                'amount_total' => Car::find($request->car_id)->price * $request->quantity,
                'status' => 1,
            ])->toArray();

            Book::create($data);
            return response()->json('Đặt vé thành công.', 200);
        } catch (\Exception $e) {
            return response()->json('Có lỗi xảy ra, vui lòng thử lại.', 500);
        }
    }

    public function post($id)
    {
        $data = Post::find($id);
        $places = $this->places();
        $posts = Post::isActive()->get();

        return view('post', compact('data', 'places', 'posts'));
    }
}
