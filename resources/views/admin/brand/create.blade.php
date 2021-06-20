@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Thêm hãng xe</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/brands">Danh sách hãng xe</a></li>
        <li class="active">Thêm hãng xe</li>
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
        <form action="{{route('brands.store')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            {{--name--}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="content">Tên hãng xe<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control" required>
                @if($errors->has('name'))
                    <div class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            {{--email--}}
            <div class="form-group {{ $errors->has('hotline') ? 'has-error' : '' }}">
                <label for="hotline">Hotline<span class="text-danger">*</span></label>
                <input type="text" name="hotline" id="hotline" value="{{ old('hotline') }}"
                       class="form-control" required>
                <small class="text-muted">1900 686868,1900 ....</small>
                @if($errors->has('hotline'))
                    <div class="help-block">
                        <strong>{{ $errors->first('hotline') }}</strong>
                    </div>
                @endif
            </div>
            {{--owner--}}
            <div class="form-group {{ $errors->has('owner') ? 'has-error' : '' }}">
                <label for="owner">Người quản lý:</label>
                <select name="owner" id="owner" class="form-control select2" required>
                    <option value="">Chọn</option>
                    @foreach($users as $item)
                        <option value="{{$item->id}}">{{$item->name}} - {{$item->email}} - {{$item->phone}}</option>
                    @endforeach
                </select>
                <small class="text-muted">Tên - Email - Điện thoại</small>
                @if($errors->has('owner'))
                    <div class="help-block">
                        <strong>{{ $errors->first('owner') }}</strong>
                    </div>
                @endif
            </div>

            {{--status--}}
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control "
                        required>
                    @foreach(\App\Brand::STATUS as $key=>$item)
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