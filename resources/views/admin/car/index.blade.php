@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Danh sách xe</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Danh sách xe</li>
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
                <th>Hãng xe</th>
                <th>Hình ảnh</th>
                <th>Thông tin xe</th>
                <th>Trạng thái</th>
                <th class="text-center">
                    <a href="{{route('cars.create')}}" class="btn btn-sm btn-primary ml-2">Thêm mới</a>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>{{$item->brand->name}}</td>
                    <td>
                        <img width="75" src="{{asset('uploads/cars/'.$item->image)}}" alt="">
                    </td>
                    <td>
                        <ul>
                            <li>
                                <strong>Tuyến:</strong> {{$item->start->name}} <i
                                        class="fas fa-fw fa-exchange-alt"></i> {{$item->end->name}}
                            </li>
                            <li>
                                <strong>Loại xe:</strong> {{$item->type_car}} - <strong>Số
                                    chỗ:</strong> {{$item->number_seats}}
                            </li>
                            <li>
                                <strong>Thời gian chạy:</strong> {{$item->total_time}} -
                                <strong>Giá:</strong> {{$item->price}}
                            </li>
                        </ul>
                    </td>
                    <td>{{\App\Car::STATUS[$item->status]}}</td>
                    <td class="text-center">
                        <form onsubmit="if(!confirm('Bạn chọn xóa')) event.preventDefault();"
                              action="{{route('cars.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="delete"/>

                            <a class="btn btn-sm btn-warning" href="{{route('cars.show', $item->id)}}"><i
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