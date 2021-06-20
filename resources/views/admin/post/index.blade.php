@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Danh sách bài viết</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Danh sách bài viết</li>
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
                <th>Tên bài viết</th>
                <th>Mô tả ngắn</th>
                <th>Tác giả</th>
                <th>Trạng thái</th>
                <th class="text-center">
                    <a href="{{route('posts.create')}}" class="btn btn-sm btn-primary ml-2">Thêm mới</a>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>
                        {{$item->description}}
                    </td>
                    <td>
                        {{$item->user->name}}
                    </td>
                    <td>{{\App\Post::STATUS[$item->status]}}</td>
                    <td class="text-center">
                        <form onsubmit="if(!confirm('Bạn chọn xóa')) event.preventDefault();"
                              action="{{route('posts.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="delete"/>

                            <a class="btn btn-sm btn-warning" href="{{route('posts.show', $item->id)}}"><i
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