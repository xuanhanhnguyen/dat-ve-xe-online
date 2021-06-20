@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Danh sách đặt vé</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Danh sách đặt vé</li>
    </ol>
@stop

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo</h4>
            {{ session('message') }}
        </div>
    @endif
    <div class="box box-primary p-3">
        <table id="data-table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Thông tin xe</th>
                <th>Thông tin khách hàng</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th class="text-center">
                    <a href="{{route('books.create')}}" class="btn btn-sm btn-primary ml-2">Thêm mới</a>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>
                        <li><strong>Hãng xe:</strong> {{$item->car->brand->name}}</li>
                        <li>
                            <strong>Tuyến:</strong> {{$item->car->start->name}} <i
                                    class="fas fa-fw fa-exchange-alt"></i> {{$item->car->end->name}}
                        </li>
                        <li>
                            <strong>Loại xe:</strong> {{$item->car->type_car}} - <strong>Số
                                chỗ:</strong> {{$item->car->number_seats}}
                        </li>
                        <li>
                            <strong>Thời gian chạy:</strong> {{$item->car->total_time}} -
                            <strong>Giá/1 vé:</strong> {{$item->car->price}}
                        </li>
                    </td>
                    <td>
                        <li><strong>Họ & tên:</strong> {{$item->name}}</li>
                        <li><strong>Số điện thoại:</strong> {{$item->phone}}</li>
                    </td>
                    <td>
                        {{$item->quantity}}
                    </td>
                    <td>
                        {{$item->amount_total}}
                    </td>
                    <td>{{\App\Book::STATUS[$item->status]}}</td>
                    <td class="text-center">
                        <form onsubmit="if(!confirm('Bạn chọn xóa')) event.preventDefault();"
                              action="{{route('books.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="delete"/>

                            <a class="btn btn-sm btn-warning" href="{{route('books.show', $item->id)}}"><i
                                        class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@stop

@section('footer')
    <div class="text-center">
        <strong>Copyright &copy; <a href="#">vexere.com</a>.</strong>
    </div>
@stop