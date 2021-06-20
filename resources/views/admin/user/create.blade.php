@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Thêm tài khoản</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/users">Danh sách tài khoản</a></li>
        <li class="active">Thêm tài khoản</li>
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
        <form action="{{route('users.store')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            {{--name--}}
            <div class="form-group {{ $errors->has('name') ? 'has-eror' : '' }}">
                <label for="content">Họ & tên<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control" required>
                @if($errors->has('name'))
                    <div class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            {{--email--}}
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="name">Email<span class="text-danger">*</span></label>
                <input type="email" name="email" id="name" value="{{ old('email') }}"
                       class="form-control" required>
                @if($errors->has('email'))
                    <div class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>

            {{--phone--}}
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="name">Số điện thoại<span class="text-danger">*</span></label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                       class="form-control" required>
                @if($errors->has('phone'))
                    <div class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </div>
                @endif
            </div>

            {{--email--}}
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Mật khẩu<span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" value="{{ old('password') }}"
                       class="form-control" required>
                @if($errors->has('password'))
                    <div class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
            </div>
            {{--role--}}
            <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                <label for="role">Chức vụ:</label>
                <select name="role" id="role" class="form-control "
                        required>
                    @foreach(\App\User::ROLE as $key=>$item)
                        <option value="{{$key}}" @if($key == "member") selected @endif>{{$item}}</option>
                    @endforeach
                </select>
                @if($errors->has('role'))
                    <div class="help-block">
                        <strong>{{ $errors->first('role') }}</strong>
                    </div>
                @endif
            </div>

            {{--status--}}
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control "
                        required>
                    @foreach(\App\User::STATUS as $key=>$item)
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
