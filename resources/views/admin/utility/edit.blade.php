@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Thêm tiện ích</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/admin/utilities">Danh sách tiện ích</a></li>
        <li class="active">Thêm tiện ích</li>
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
        <form action="{{route('utilities.update', $data->id)}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="put">

            {{--image--}}
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image">Hình ảnh minh họa:</label>
                <input accept="image/*" type="file" name="image" id="image">
                <script type="text/javascript">
                    image.onchange = e => {
                        const [file] = image.files;
                        if (file) {
                            preview.src = URL.createObjectURL(file);
                        }
                    }
                </script>
                @if($errors->has('image'))
                    <div class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </div>
                @endif

                <img class="mt-2" width="50" id="preview" src="{{asset('/uploads/utilities/' . $data->image)}}">
            </div>

            {{--name--}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="content">Tên tiện ích<span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" value="{{ $data->name }}"
                       class="form-control" required>
                @if($errors->has('name'))
                    <div class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>
            {{--email--}}
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Mô tả:</label>
                <textarea name="description" id="description" class="form-control"
                          rows="4">{{ $data->description }}</textarea>
                @if($errors->has('description'))
                    <div class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </div>
                @endif
            </div>
            {{--status--}}
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control "
                        required>
                    @foreach(\App\Utility::STATUS as $key=>$item)
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