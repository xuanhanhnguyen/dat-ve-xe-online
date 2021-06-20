<?php

namespace App\Http\Controllers\Admin;

use App\StopoverStation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StopoverStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StopoverStation::all();
        return view('admin.stopover-station.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stopover-station.create');
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
            StopoverStation::create($request->all());
            return view('admin.stopover-station.index')->with('message', 'Thêm thành công.');
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
        $data = StopoverStation::find($id);
        return view('admin.stopover-station.edit', compact('data'));
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
            StopoverStation::find($id)->update($request->all());

            return view('admin.stopover-station.index')->with('message', 'Cập nhật thành công.');
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
            StopoverStation::destroy($id);

            return view('admin.stopover-station.index')->with('message', 'Xóa thành công.');
        } catch (\Exception $e) {
            \Log::debug($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
