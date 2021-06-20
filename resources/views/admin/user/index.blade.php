@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Danh sách tài khoản</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Danh sách tài khoản</li>
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
                <th>Tên tài khoản</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Chức vụ</th>
                <th>Trạng thái</th>
                <th class="text-center"><a href="{{route('users.create')}}" class="btn btn-sm btn-primary ml-2">Thêm
                        mới</a></th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{\App\User::ROLE[$item->role]}}</td>
                    <td>{{\App\User::STATUS[$item->status]}}</td>
                    <td class="text-center">
                        <form onsubmit="if(!confirm('Bạn chọn xóa')) event.preventDefault();"
                              action="{{route('users.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="delete"/>

                            <a class="btn btn-sm btn-warning" href="{{route('users.show', $item->id)}}"><i
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