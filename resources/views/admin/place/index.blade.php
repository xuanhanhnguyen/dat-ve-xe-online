@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Danh sách điểm đến</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Danh sách điểm đến</li>
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
                <th>Tên điểm đến</th>
                <th>Thuộc điểm đến</th>
                <th>Loại điểm đến</th>
                <th class="text-center">
                    <a href="{{route('places.create')}}" class="btn btn-sm btn-primary ml-2">Thêm mới</a>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>
                        {{$item->parent->name ?? ''}}
                    </td>
                    <td>
                        {{\App\Place::GROUP[$item->group]}}
                    </td>
                    <td class="text-center">
                        <form onsubmit="if(!confirm('Bạn chọn xóa')) event.preventDefault();"
                              action="{{route('places.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="delete"/>

                            <a class="btn btn-sm btn-warning" href="{{route('places.show', $item->id)}}"><i
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