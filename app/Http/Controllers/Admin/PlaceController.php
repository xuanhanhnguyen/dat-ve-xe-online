<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{

    public function group()
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
        $data = Place::with('parent')->get();
        return view('admin.place.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = $this->group();
        return view('admin.place.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255|unique:places',
        ]);
        try {
            Place::create($request->all());
            return redirect(route('places.index'))->with('message', 'Thêm thành công.');
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
        $data = Place::find($id);
        $group = $this->group();

        return view('admin.place.edit', compact('data', 'group'));
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
        $request->validate([
            'name' => 'required|string|min:5|max:255|unique:places,name,' . $id . ',id',
        ]);

        try {

            Place::find($id)->update($request->all());
            return redirect(route('places.index'))->with('message', 'Cập nhật thành công.');
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
            Place::destroy($id);

            return redirect(route('places.index'))->with('message', 'Xóa thành công.');
        } catch (\Exception $e) {
            \Log::debug($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
