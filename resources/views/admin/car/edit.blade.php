@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Chỉnh sửa thông tin xe</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/cars">Danh sách xe</a></li>
        <li class="active">Chỉnh sửa thông tin xe</li>
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
        <form action="{{route('cars.update', $data->id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">

            {{--brand--}}
            <div class="form-group {{ $errors->has('brand_id') ? 'has-error' : '' }}">
                <label for="brand_id">Hãng xe:</label>
                <select name="brand_id" id="brand_id" class="form-control select2" required>
                    <option value="">Chọn</option>
                    @foreach($brands as $item)
                        <option value="{{$item->id}}"
                                @if($data->brand_id == $item->id) selected @endif>{{$item->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('brand_id'))
                    <div class="help-block">
                        <strong>{{ $errors->first('brand_id') }}</strong>
                    </div>
                @endif
            </div>

            <div class="row">
                {{--utility--}}
                <div class="form-group col-md-6">
                    <label for="utilities">Tiện ích:</label>
                    <select multiple name="utilities[]" id="utilities" class="form-control select2">
                        @foreach($utilities as $item)
                            <option value="{{$item->id}}"
                                    @if(array_search($item->id, array_column($data->utilities->toArray(), 'id')) !== false) selected @endif >{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                {{--image--}}
                <div class="col-md-6 form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                    <label for="image">Hình ảnh:</label>
                    <input accept="image/*" type="file" name="image" id="image">
                    <script type="text/javascript">
                        image.onchange = e => {
                            const [file] = image.files;
                            if (file) {
                                preview.src = URL.createObjectURL(file);
                                $('#preview').show();
                            }
                        }
                    </script>
                    @if($errors->has('image'))
                        <div class="help-block">
                            <strong>{{ $errors->first('image')}}</strong>
                        </div>
                    @endif

                    <img class="mt-2" width="50" id="preview" src="{{asset('uploads/cars/' . $data->image)}}">
                </div>
            </div>


            <div class="row">
                {{--type car--}}
                <div class="form-group col-md-6 {{ $errors->has('type_car') ? 'has-error' : '' }}">
                    <label for="type_car">Loại xe:<span class="text-danger">*</span></label>
                    <input type="text" name="type_car" id="type_car" value="{{ $data->type_car }}"
                           class="form-control" required>
                    @if($errors->has('name'))
                        <div class="help-block">
                            <strong>{{ $errors->first('type_car') }}</strong>
                        </div>
                    @endif
                </div>
                {{--number seats--}}
                <div class="form-group col-md-6 {{ $errors->has('number_seats') ? 'has-error' : '' }}">
                    <label for="number_seats">Sỗ chỗ<span class="text-danger">*</span></label>
                    <input type="number" name="number_seats" id="number_seats" value="{{ $data->number_seats }}"
                           class="form-control" required>
                    @if($errors->has('number_seats'))
                        <div class="help-block">
                            <strong>{{ $errors->first('number_seats') }}</strong>
                        </div>
                    @endif
                </div>
            </div>

            {{--station--}}
            <div class="row form-group">
                <div class="col-md-12">
                    <label for="station">Tuyến đường:<span class="text-danger">*</span></label>
                </div>
                <div class="form-group col-md-6">
                    <select name="station_a" id="station_a" class="form-control select2" required>
                        <option value="">Chọn</option>
                        @foreach($places as $key => $item)
                            <optgroup label="{{\App\Place::GROUP[$key]}}">
                                @foreach($item as $_item)
                                    <option value="{{$_item->id}}"
                                            @if($_item->id == $data->station_a) selected @endif>{{$_item->name}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                {{--number seats--}}
                <div class="form-group col-md-6">
                    <select name="station_b" id="station_b" class="form-control select2">
                        <option value="">Chọn</option>
                        @foreach($places as $key => $item)
                            <optgroup label="{{\App\Place::GROUP[$key]}}">
                                @foreach($item as $_item)
                                    <option value="{{$_item->id}}"
                                            @if($_item->id == $data->station_b) selected @endif>{{$_item->name}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>

            {{--time--}}
            <div class="row">
                {{--time a--}}
                <div class="form-group col-md-6">
                    <small class="text-muted">Mốc thời gian bắt đầu chạy<span class="text-danger">*</span></small>
                    <input type="text" name="time_start_a" id="time_start_a" value="{{ $data->time_start_a }}"
                           class="form-control" placeholder="Mốc thời gian bắt đầu chạy" required>
                    <small class="text-muted">21:00,21:45, ...</small>
                    @if($errors->has('time_start_a'))
                        <div class="help-block">
                            <strong>{{ $errors->first('time_start_a') }}</strong>
                        </div>
                    @endif
                </div>
                {{--time b--}}
                <div class="form-group col-md-6">
                    <small class="text-muted">Mốc thời gian bắt đầu chạy<span class="text-danger">*</span></small>
                    <input type="text" name="time_start_b" id="time_start_b" value="{{ $data->time_start_b }}"
                           class="form-control" placeholder="Mốc thời gian bắt đầu chạy" required>
                    <small class="text-muted">21:00,21:45, ...</small>
                    @if($errors->has('time_start_b'))
                        <div class="help-block">
                            <strong>{{ $errors->first('time_start_b') }}</strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                {{--Total time--}}
                <div class="form-group col-md-6 {{ $errors->has('total_time') ? 'has-error' : '' }}">
                    <label for="total_time">Tổng thời gian chạy:<span class="text-danger">*</span></label>
                    <input type="text" name="total_time" id="total_time" value="{{ $data->total_time }}"
                           class="form-control" required>
                    @if($errors->has('total_time'))
                        <div class="help-block">
                            <strong>{{ $errors->first('total_time') }}</strong>
                        </div>
                    @endif
                </div>
                {{--price--}}
                <div class="form-group col-md-6 {{ $errors->has('price') ? 'has-error' : '' }}">
                    <label for="price">Giá tiền:<span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" value="{{ $data->price }}"
                           class="form-control" required>
                    @if($errors->has('price'))
                        <div class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </div>
                    @endif
                </div>
            </div>

            {{--status--}}
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control "
                        required>
                    @foreach(\App\Car::STATUS as $key=>$item)
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