@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Thêm điểm đến</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/places">Danh sách điểm đến</a></li>
        <li class="active">Thêm điểm đến</li>
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
        <form action="{{route('places.store')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            {{--name--}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="content">Tên điểm đến<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-control" required>
                @if($errors->has('name'))
                    <div class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            {{--parent_id--}}
            <div class="form-group {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                <label for="parent_id">Thuộc điểm đến:</label>
                <select name="parent_id" id="parent_id" class="form-control select2">
                    <option value="">Chọn</option>
                    @foreach($group as $key => $item)
                        <optgroup label="{{\App\Place::GROUP[$key]}}">
                            @foreach($item as $_item)
                                <option value="{{$_item->id}}">{{$_item->name}}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                @if($errors->has('parent_id'))
                    <div class="help-block">
                        <strong>{{ $errors->first('parent_id') }}</strong>
                    </div>
                @endif
            </div>

            {{--group--}}
            <div class="form-group {{ $errors->has('group') ? 'has-error' : '' }}">
                <label for="group">Loại điểm đến:<span class="text-danger">*</span></label>
                <select name="group" id="group" class="form-control "
                        required>
                    @foreach(\App\Place::GROUP as $key=>$item)
                        <option value="{{$key}}">{{$item}}</option>
                    @endforeach
                </select>
                @if($errors->has('group'))
                    <div class="help-block">
                        <strong>{{ $errors->first('group') }}</strong>
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