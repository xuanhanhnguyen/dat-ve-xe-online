@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Danh sách hãng xe</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Danh sách hãng xe</li>
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
                <th>Hotline</th>
                <th>Người quản lý</th>
                <th>Trạng thái</th>
                <th class="text-center">
                    @if(Auth::user()->role !== "member")
                        <a href="{{route('brands.create')}}" class="btn btn-sm btn-primary ml-2">Thêm mới</a>
                    @endif
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>

                        <ul>
                            @foreach(explode(',', $item->hotline) as $phone)
                                <li>{{$phone}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>{{$item->user->name}}</li>
                            <li>{{$item->user->email}}</li>
                            <li>{{$item->user->phone}}</li>
                        </ul>
                    </td>
                    <td>{{\App\Brand::STATUS[$item->status]}}</td>
                    <td class="text-center">
                        <form onsubmit="if(!confirm('Bạn chọn xóa')) event.preventDefault();"
                              action="{{route('brands.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="delete"/>

                            <a class="btn btn-sm btn-warning" href="{{route('brands.show', $item->id)}}"><i
                                        class="fas fa-edit"></i></a>
                            @if(Auth::user()->role !== "member")
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i></button>
                            @endif
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