@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Chỉnh sửa thông tin đặt vé</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/books">Danh sách đặt vé</a></li>
        <li class="active">Chỉnh sửa thông tin đặt vé</li>
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
        <form action="{{route('books.update', $data->id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">

            {{--brand--}}
            <div class="form-group {{ $errors->has('car_id') ? 'has-error' : '' }}">
                <label for="car_id">Chọn xe:</label>

                <select disabled name="car_id" id="car_id" class="form-control select2" required>
                    <option value="">Chọn</option>
                    @foreach($brands as $brand)
                        <optgroup label="{{$brand->name}}">
                            @foreach($brand->cars as $car)
                                <option value="{{$car->id}}"
                                        @if($car->id == $data->car_id) selected @endif>{{$brand->name}}
                                    : {{$car->start->name}}
                                    <-> {{$car->end->name}}</option>
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

            {{--brand--}}
            <div class="form-group {{ $errors->has('a_to_b') ? 'has-error' : '' }}">
                <label for="a_to_b">Chọn tuyến:</label>
                <select name="a_to_b" id="a_to_b" class="form-control" required>
                    <option value="1" @if($data->a_to_b == 1) selected @endif>{{$car->start->name}}
                        <-> {{$car->end->name}}</option>
                    <option value="0" @if($data->a_to_b == 0) selected @endif>{{$car->end->name}}
                        <-> {{$car->start->name}}</option>
                </select>
                @if($errors->has('a_to_b'))
                    <div class="help-block">
                        <strong>{{ $errors->first('a_to_b') }}</strong>
                    </div>
                @endif
            </div>

            {{--name--}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Tên khách hàng:<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ $data->name }}"
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
                <input type="number" name="phone" id="phone" value="{{ $data->phone }}"
                       class="form-control" required>
                @if($errors->has('phone'))
                    <div class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </div>
                @endif
            </div>

            {{--price--}}
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">Số lượng:<span class="text-danger">*</span></label>
                <input type="number" name="price" id="price" value="{{ $data->price }}" min="1"
                       onchange="$('#amount_total').val($('#quantity').val() * $('#price').val())"
                       class="form-control" required>
                @if($errors->has('price'))
                    <div class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </div>
                @endif
            </div>

            {{--quantity--}}
            <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                <label for="quantity">Số lượng:<span class="text-danger">*</span></label>
                <input type="number" name="quantity" id="quantity" value="{{ $data->quantity }}" min="1" max="60"
                       onchange="$('#amount_total').val($('#quantity').val() * $('#price').val())"
                       class="form-control" required>
                @if($errors->has('quantity'))
                    <div class="help-block">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </div>
                @endif
            </div>

            {{--price--}}
            <div class="form-group {{ $errors->has('amount_total') ? 'has-error' : '' }}">
                <label for="amount_total">Tổng tiền:<span class="text-danger">*</span></label>
                <input disabled type="number" name="price" id="amount_total" value="{{ $data->amount_total }}" min="1"
                       class="form-control">
                @if($errors->has('amount_total'))
                    <div class="help-block">
                        <strong>{{ $errors->first('amount_total') }}</strong>
                    </div>
                @endif
            </div>

            {{--status--}}
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control "
                        required>
                    @foreach(\App\Book::STATUS as $key=>$item)
                        <option value="{{$key}}" @if($key == $data->status) selected @endif>{{$item}}</option>
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
                <button type="submit" class="btn btn-sm btn-warning">Cập nhật</button>
            </div>
        </form>
    </div>
@stop

@section('footer')
    <div class="text-center">
        <strong>Copyright &copy; <a href="#">vexere.com</a>.</strong>
    </div>
@stop