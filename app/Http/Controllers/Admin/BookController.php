<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Brand;
use App\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::all();
        return view('admin.book.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::with('cars')->get();
        return view('admin.book.create', compact('brands'));
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

            $data = collect($request->all())->merge([
                'price' => Car::find($request->car_id)->price,
                'amount_total' => Car::find($request->car_id)->price * $request->quantity,
                'status' => 1,
            ])->toArray();

            Book::create($data);
            return redirect(route('books.index'))->with('message', 'Thêm thành công.');
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
        $data = Book::find($id);
        $brands = Brand::with('cars')->get();
        return view('admin.book.edit', compact('data', 'brands'));
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
            $data = collect($request->all())->merge([
                'amount_total' => $request->price * $request->quantity,
            ])->toArray();

            Book::find($id)->update($data);

            return redirect(route('books.index'))->with('message', 'Cập nhật thành công.');
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
            Book::destroy($id);

            return redirect(route('books.index'))->with('message', 'Xóa thành công.');
        } catch (\Exception $e) {
            \Log::debug($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }
}
