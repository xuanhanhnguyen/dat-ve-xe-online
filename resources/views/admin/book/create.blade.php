@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Đặt vé xe</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/books">Danh sách đặt vé</a></li>
        <li class="active">Đặt vé xe</li>
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
        <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

            {{--brand--}}
            <div class="form-group {{ $errors->has('car_id') ? 'has-error' : '' }}">
                <label for="car_id">Chọn xe:</label>

                <select name="car_id" id="car_id" class="form-control select2" required>
                    <option value="">Chọn</option>
                    @foreach($brands as $brand)
                        <optgroup label="{{$brand->name}}">
                            @foreach($brand->cars as $car)
                                <option value="{{$car->id}}">{{$car->start->name}} <-> {{$car->end->name}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @if($errors->has('car_id'))
                    <div class="help-block">
                        <strong>{{ $errors->first('car_id') }}</strong>
                    </div>
                @endif
            </div>

            {{--name--}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Tên khách hàng:<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control" required>
                @if($errors->has('name'))
                    <div class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>

            {{--phone--}}
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">Số điện thoại:<span class="text-danger">*</span></label>
                <input type="number" name="phone" id="phone" value="{{ old('phone') }}"
                       class="form-control" required>
                @if($errors->has('phone'))
                    <div class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </div>
                @endif
            </div>

            {{--quantity--}}
            <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                <label for="quantity">Số lượng:<span class="text-danger">*</span></label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity')?:1 }}" min="1" max="60"
                       class="form-control" required>
                @if($errors->has('quantity'))
                    <div class="help-block">
                        <strong>{{ $errors->first('quantity') }}</strong>
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