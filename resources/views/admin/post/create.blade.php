@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Thêm bài viết</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/posts">Danh sách bài viết</a></li>
        <li class="active">Thêm bài viết</li>
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
        <form action="{{route('posts.store')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            {{--name--}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Tên bài viết<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control" required>
                @if($errors->has('name'))
                    <div class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            {{--description--}}
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Mô tả ngắn<span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" id="description" cols="30"
                          rows="5">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </div>
                @endif
            </div>
            {{--content--}}
            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                <label for="content">Nội dung:<span class="text-danger">*</span></label>
                <textarea id="editor" class="form-control" name="content" id="content" cols="30"
                          rows="10">{{ old('content') }}</textarea>
                @if($errors->has('content'))
                    <div class="help-block">
                        <strong>{{ $errors->first('content') }}</strong>
                    </div>
                @endif
            </div>

            {{--status--}}
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control "
                        required>
                    @foreach(\App\Post::STATUS as $key=>$item)
                        <option value="{{$key}}" @if($key == 1) selected @endif>{{$item}}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="help-block">
                        <strong>{{ $errors->first('status') }}</strong>
                    </div>
                @endif
            </div>
            {{--button--}}
            <div class="text-center">
                <button type="submit" class="btn btn-sm btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
@stop

@section('footer')
    <div class="text-center">
        <strong>Copyright &copy; <a href="#">vexere.com</a>.</strong>
    </div>
@stop

@section('js')
    <script src="{{asset('/vendor/adminlte/vendor/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(function () {
            CKEDITOR.replace('editor');
        })
    </script>
@stop