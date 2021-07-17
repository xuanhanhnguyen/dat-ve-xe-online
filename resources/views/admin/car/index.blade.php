@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Danh sách xe</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Danh sách xe</li>
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
                <th>Hãng xe</th>
                <th>Hình ảnh</th>
                <th>Thông tin xe</th>
                <th>Trạng thái</th>
                <th class="text-center">
                    <a href="{{route('cars.create')}}" class="btn btn-sm btn-primary ml-2">Thêm mới</a>
                </th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>{{$item->brand->name}}</td>
                    <td>
                        <img width="75" src="{{asset('uploads/cars/'.$item->image)}}" alt="">
                    </td>
                    <td>
                        <ul>
                            <li><b>Biển số xe:</b> {{$item->license_plates}}</li>
                            <li><b>Tài xế:</b> {{$item->driver}}</li>
                            <li>
                                <strong>Tuyến:</strong> {{$item->start->name}} <i
                                        class="fas fa-fw fa-exchange-alt"></i> {{$item->end->name}}
                            </li>
                            <li>
                                <strong>Loại xe:</strong> {{$item->type_car}} - <strong>Số
                                    chỗ:</strong> {{$item->number_seats}}
                            </li>
                            <li>
                                <strong>Thời gian chạy:</strong> {{$item->total_time}} -
                                <strong>Giá:</strong> {{_price($item->price)}}
                            </li>
                        </ul>
                    </td>
                    <td>{{\App\Car::STATUS[$item->status]}}</td>
                    <td>
                        <form class="text-center" onsubmit="if(!confirm('Bạn chọn xóa')) event.preventDefault();"
                              action="{{route('cars.destroy', $item->id)}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="delete"/>
                            <a class="btn btn-sm btn-primary" href="#" data-toggle="modal"
                               data-target="#car_{{$item->id}}"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-sm btn-warning" href="{{route('cars.show', $item->id)}}"><i
                                        class="fas fa-edit"></i></a>
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i></button>
                        </form>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="car_{{$item->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header pb-0">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Đánh giá & bình luận</h5>
                                        <button style="position: relative; top: -20px;" type="button" class="close"
                                                data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!--post like-->
                                        <div class="fb-like"
                                             data-href="http://fgc.vn/test-fb-{{$item->id}}"
                                             data-layout="standard" data-action="like"
                                             data-size="small"
                                             data-share="true"
                                             data-width="720"
                                             data-show-faces="true">
                                        </div>
                                        <!--post comment-->
                                        <div class="fb-comments"
                                             data-href="http://fgc.vn/test-fb-{{$item->id}}"
                                             data-numposts="5"
                                             data-width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

@section('js')
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '',
                xfbml: true,
                version: 'v8.0'
            });
            FB.AppEvents.logPageView();
        };
        (function (d, s, id) {
            let js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/vi_VN/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@stop