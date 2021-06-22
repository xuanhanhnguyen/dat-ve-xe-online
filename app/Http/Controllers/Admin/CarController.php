<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Car;
use App\Http\Controllers\Controller;
use App\Place;
use App\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role === "member") {
            $data = Car::has('member')->get();
        } else
            $data = Car::all();

        return view('admin.car.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role === "member") {
            $brands = Brand::isActive()->where('owner', Auth::id())->get();
        } else
            $brands = Brand::isActive()->get();
        $places = $this->places();
        $utilities = Utility::isActive()->get();
        return view('admin.car.create', compact('places', 'brands', 'utilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move('uploads/cars', $fileName);
            }

            $data = collect($request->all())->merge([
                'image' => $fileName ?? ""
            ])->toArray();

            if (!$request->hasFile('image')) unset($data['image']);

            $car = Car::create($data);

            //insert utilities
            $utilities = $request->utilities;
            if ($utilities) {
                $car->utilities()->sync($utilities);
            }

            return redirect(route('cars.index'))->with('message', 'Thêm thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->role === "member") {
            $brands = Brand::isActive()->where('owner', Auth::id())->get();
        } else
            $brands = Brand::isActive()->get();

        $data = Car::find($id);
        $places = $this->places();
        $utilities = Utility::isActive()->get();
        return view('admin.car.edit', compact('data', 'places', 'brands', 'utilities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->hasFile('image')) {
                $fileName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move('uploads/utilities', $fileName);
            }

            $data = collect($request->all())->merge([
                'image' => $fileName ?? ""
            ])->toArray();

            if (!$request->hasFile('image')) unset($data['image']);

            Car::find($id)->update($data);

            //insert utilities
            $utilities = $request->utilities;
            if ($utilities) {
                Car::find($id)->utilities()->sync($utilities);
            }

            return redirect(route('cars.index'))->with('message', 'Cập nhật thành công.');
        } catch (\Exception $e) {
            \Log::debug($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Car::find($id)->utilities()->detach();
            Car::destroy($id);

            return redirect(route('cars.index'))->with('message', 'Xóa thành công.');
        } catch (\Exception $e) {
            \Log::debug($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
