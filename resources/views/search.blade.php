@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{asset('/vendor/owl-carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/vendor/owl-carousel/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    <style>

        header {
            box-shadow: rgb(0 0 0 / 5%) 0 3px 5px;
            margin-bottom: 30px;
        }

        .banner form {
            width: 100%;
            height: 100%;
        }

        .banner .btn-switch {
            background: white;
            padding: 9px 10px;
            cursor: pointer;
            border: 1px solid #dee2e6;
            border-right: 0;
            border-left: 0;
        }

        .banner select.form-control {
            border-radius: 0;
            border-color: white;
            font-size: 18px;
            height: auto;
            padding: 10px;
            min-width: 250px !important;
            min-height: 48px;
        }

        .banner .select2 {
            min-height: 48px;
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid #dee2e6;
        }

        .banner form .select2:nth-child(2) {
            border-right: 0;
        }

        .banner form .select2:nth-child(5) {
            border-left: 0;
        }

        .banner .select2 .select2-selection__rendered {
            min-width: 250px;
        }

        .banner .select2 .select2-selection--single {
            border: 0 !important;
        }

        .banner .select2 .select2-selection__arrow {
            top: 11px !important;
        }

        .banner select.form-control:focus {
            box-shadow: none;
        }

        .banner select.form-control[name='station_a'] {
            border-right: 0;
        }

        .banner select.form-control[name='station_b'] {
            border-left: 0;
        }

        .banner button#btn-search {
            padding: 11px;
            border-radius: 0;
        }

        footer {
            background: 0% 0% no-repeat padding-box padding-box rgb(243, 243, 243);
        }

        ul.pagination {
            display: inline-flex;
        }

        ul.pagination li.disabled {
            display: none;
        }

        ul.pagination li.active span {
            color: #fff !important;
            background-color: #007bff;
            border-color: #007bff;
        }

        ul.pagination li span, ul.pagination li a {
            z-index: 1;
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        ul.pagination li span {
            background: white;
            color: black !important;
        }
    </style>
@stop

@section('content')

    <div class="banner">
        <form class="position-relative d-inline-flex justify-content-center align-items-center" action="">
            <select name="station_a" class="form-control w-auto select2">
                <option value="">Chọn</option>
                @foreach($places as $key => $item)
                    <optgroup label="{{\App\Place::GROUP[$key]}}">
                        @foreach($item as $_item)
                            <option value="{{$_item->id}}"
                                    @if($_item->id == $_GET['station_a']) selected @endif>{{$_item->name}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>

            <div id="btn-switch" class="btn-switch">
                <svg class="DesktopSearchWidget2__IconExchangedStyled-sc-18055jv-1 bAWRMb"
                     xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                    <g stroke="#0060c4">
                        <g fill="#fff">
                            <circle cx="14" cy="14" r="14" stroke="none"></circle>
                            <circle cx="14" cy="14" r="13.5" fill="none"></circle>
                        </g>
                        <path fill="none" stroke-linecap="round" stroke-miterlimit="10"
                              d="M20 10.5H8.5M20.5 10.5L17 7M20.5 10.5L17 14M19.5 17.5H9M8 17.5l3.5-3.5M11.5 21L8 17.5"></path>
                    </g>
                </svg>
            </div>

            <select name="station_b" class="form-control w-auto select2">
                <option value="">Chọn</option>
                @foreach($places as $key => $item)
                    <optgroup label="{{\App\Place::GROUP[$key]}}">
                        @foreach($item as $_item)
                            <option value="{{$_item->id}}"
                                    @if($_item->id == $_GET['station_b']) selected @endif>{{$_item->name}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>

            <button id="btn-search" class="btn btn-warning">Tìm chuyến</button>
        </form>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <aside class="sidebar">
                    <h5 style="font-size: 18px" class="d-block text-center mb-4">Lọc kết quả tìm kiếm</h5>
                    <form action="" method="get" class="border p-3">

                        <input type="hidden" name="station_a" value="{{$_GET['station_a']}}">
                        <input type="hidden" name="station_b" value="{{$_GET['station_b']}}">

                        <div class="form-group">
                            <label class="mb-0">Giờ khởi hành</label>
                            <select class="form-control form-control-sm" name="time_start">
                                <option value="">Tất cả</option>
                                @foreach($times as $item)
                                    <option @if(isset($_GET['time_start']) && $item == $_GET['time_start']) selected
                                            @endif value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-block mt-2 mb-0">Nhà xe</label>
                            <select name="brand_id" class="form-control form-control-sm">
                                <option value="">Tất cả</option>
                                @foreach($brands as $item)
                                    <option @if(isset($_GET['brand_id']) && $item->id == $_GET['brand_id']) selected
                                            @endif value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="d-block mt-2 mb-0">Loại xe</label>
                            <select name="type_car" class="form-control form-control-sm">
                                <option value="">Tất cả</option>
                                @foreach($type_cars as $item)
                                    <option @if(isset($_GET['type_car']) && $item == $_GET['type_car']) selected
                                            @endif value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-sm btn-warning">Tìm kiếm</button>
                        </div>
                    </form>
                </aside>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h5 style="font-size: 18px" class="d-block text-center mb-4">kết quả tìm kiếm</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @foreach($cars as $car)
                            <div class="row m-0 border py-3 mb-3">
                                <div class="col-lg-3 col-md-4">
                                    @if(empty($car->image))
                                        <img class="w-100" src="{{asset('uploads/cars/default.png')}}" alt="">
                                    @else
                                        <img class="w-100" src="{{asset('uploads/cars/'.$car->image)}}" alt="">
                                    @endif
                                </div>
                                <div class="col-md-8 col-lg-9">
                                    <div class="d-flex align-item-center justify-content-between">
                                        <h6 class="text-primary mb-0"><b>{{$car->brand->name}}</b></h6>
                                        <h5 class="ml-3 text-primary mb-0">{{_price($car->price)}}</h5>
                                    </div>
                                    <!--post like-->
                                    <div class="fb-like"
                                         data-href="http://fgc.vn/test-fb-{{$car->id}}"
                                         data-layout="standard" data-action="like"
                                         data-size="small"
                                         data-width="720"
                                         data-show-faces="true">
                                    </div>
                                    <p class="mb-0">
                                        <small><b>Biển số xe:</b> {{$car->license_plates}}</small>
                                        <small class="ml-3"><b>Tài xế:</b> {{$car->driver}}</small>
                                    </p>
                                    <p class="mb-0">
                                        <small><b>Loại xe:</b> {{$car->type_car}}</small>
                                    </p>
                                    <p class="mb-1">
                                        <small><b>Giờ khởi
                                                hành:</b> {{$car->station_a == $_GET['station_a'] ? $car->time_start_a:$car->time_start_b}}
                                        </small>
                                    </p>
                                    <div class="d-flex">
                                        <div>
                                            <svg class="TicketPC__LocationRouteSVG-sc-1mxgwjh-4 dSQflF"
                                                 xmlns="http://www.w3.org/2000/svg" width="14" height="74"
                                                 viewBox="0 0 14 74">
                                                <path fill="none" stroke="#787878" stroke-linecap="round"
                                                      stroke-width="2"
                                                      stroke-dasharray="0 7" d="M7 13.5v46"></path>
                                                <g fill="none" stroke="#484848" stroke-width="3">
                                                    <circle cx="7" cy="7" r="7" stroke="none"></circle>
                                                    <circle cx="7" cy="7" r="5.5"></circle>
                                                </g>
                                                <path d="M7 58a5.953 5.953 0 0 0-6 5.891 5.657 5.657 0 0 0 .525 2.4 37.124 37.124 0 0 0 5.222 7.591.338.338 0 0 0 .506 0 37.142 37.142 0 0 0 5.222-7.582A5.655 5.655 0 0 0 13 63.9 5.953 5.953 0 0 0 7 58zm0 8.95a3.092 3.092 0 0 1-3.117-3.06 3.117 3.117 0 0 1 6.234 0A3.092 3.092 0 0 1 7 66.95z"
                                                      fill="#787878"></path>
                                            </svg>
                                        </div>

                                        <div class="ml-3">
                                            <p class="mb-0">
                                                • @if($car->station_a == $_GET['station_a']) {{$car->start->name}}
                                                ({{$car->starting_point_a}}) @else {{$car->end->name}}
                                                ({{$car->starting_point_b}}) @endif</p>
                                            <p class="mb-0 text-muted">
                                                <small>{{$car->total_time}}</small>
                                            </p>
                                            <p class="mb-0">
                                                • @if($car->station_b == $_GET['station_b']) {{$car->end->name}}
                                                ({{$car->last_point_a}}) @else {{$car->start->name}}
                                                ({{$car->last_point_b}}) @endif</p>
                                        </div>
                                    </div>
                                    <div class="mt-1 text-right">
                                        <button class="btn btn-sm btn-primary mr-2" data-toggle="modal"
                                                data-target="#detail-{{$car->id}}">Xem chi tiết
                                        </button>
                                        <button class="btn btn-sm btn-warning px-4" data-toggle="modal"
                                                onclick="form_dat_ve(`{{$car->id}}`, [{id: 0, value: `{{$car->start->name . '<->'.$car->end->name}}`}, {id: 0, value: `{{$car->end->name . '<->'.$car->start->name}}`}], parseInt(`{{$car->price}}`, 10), parseInt(`{{$car->station_a == $_GET['station_a'] ? 1:0}}`, 10), `{{$car->station_a == $_GET['station_a'] ? $car->time_start_a : $car->time_start_b}}`, `{{$car->station_a == $_GET['station_a'] ? $car->starting_point_a : $car->starting_point_b}}`, `{{$car->station_b == $_GET['station_b'] ? $car->last_point_a : $car->last_point_b}}`)"
                                                data-target="#dat-ve">Đặt vé
                                        </button>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detail-{{$car->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Chi tiết
                                                        xe</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link text-dark active" data-toggle="tab"
                                                               role="tab"
                                                               id="utility-{{$car->id}}"
                                                               aria-controls="#content-utility-{{$car->id}}"
                                                               aria-selected="true"
                                                               href="#content-utility-{{$car->id}}">Tiện ích</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link text-dark" data-toggle="tab" role="tab"
                                                               id="fb-{{$car->id}}"
                                                               aria-controls="content-fb-{{$car->id}}"
                                                               aria-selected="true"
                                                               href="#content-fb-{{$car->id}}">Đánh giá</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade show active" role="tabpanel"
                                                             aria-labelledby="utility-{{$car->id}}"
                                                             id="content-utility-{{$car->id}}">

                                                            <div class="row mt-3">
                                                                @foreach($car->utilities as $item)
                                                                    <div class="col-12">
                                                                        <div style="background: rgb(245, 245, 245); padding: 12px;"
                                                                             class="border-bottom ">
                                                                            <div class="img-name d-flex align-items-center">
                                                                                <img width="35"
                                                                                     src="{{asset('uploads/utilities/'.$item->image)}}">
                                                                                <div class="name ml-2">
                                                                                    <h6>{{$item->name}}</h6>
                                                                                </div>
                                                                            </div>
                                                                            <div class="description text-muted">
                                                                                {{$item->description}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" role="tabpanel"
                                                             id="content-fb-{{$car->id}}"
                                                             aria-labelledby="fb-{{$car->id}}">
                                                            <!--post like-->
                                                            <div class="fb-like"
                                                                 data-href="http://fgc.vn/test-fb-{{$car->id}}"
                                                                 data-layout="standard" data-action="like"
                                                                 data-size="small"
                                                                 data-share="true"
                                                                 data-width="720"
                                                                 data-show-faces="true">
                                                            </div>
                                                            <!--post comment-->
                                                            <div class="fb-comments"
                                                                 data-href="http://fgc.vn/test-fb-{{$car->id}}"
                                                                 data-numposts="5"
                                                                 data-width="100%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <nav class="col-md-12 text-center">
                        {{$cars->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dat-ve" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận đặt vé</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form onsubmit="dat_ve(event)" action="" method="post">
                    <div class="modal-body" id="confirm-dat-ve">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-warning px-3">Đặt vé</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="sale-hot mt-4">
        <div class="container">
            <div class="div">
                <h5>Ưu đãi nổi bật</h5>
            </div>
            <div class="owl-carousel owl-theme row">
                <div class="item px-3">
                    <img src="https://static.vexere.com/production/banners/330/tay-bac-trong-tam-tay_social_home-new_Vex_banner_home-641x500.png"
                         alt="">
                </div>
                <div class="item px-3">
                    <img src="https://static.vexere.com/production/banners/330/[mini-game]-het-dich-di-choi-chac-nich_vex-banner-home_641x500.png"
                         alt="">
                </div>
                <div class="item px-3">
                    <img src="https://static.vexere.com/production/banners/330/tay-bac-trong-tam-tay_social_home-new_Vex_banner_home-641x500.png"
                         alt="">
                </div>
                <div class="item px-3">
                    <img src="https://static.vexere.com/production/banners/330/shopeepay_Vex-banner-home_641x500.png"
                         alt="">
                </div>

                <div class="item px-3">
                    <img src="https://static.vexere.com/production/banners/330/dichuyenantoan50k_banner-home_641x500.png"
                         alt="">
                </div>

            </div>
        </div>
    </div>

    <div class="sale-hot mt-4">
        <div class="container">
            <div class="title">
                <h5>Bài viết nổi bật</h5>
            </div>
            <div class="row">

                @foreach($posts as $item)
                    <div class="col-12">
                        <div style="background: rgb(245, 245, 245); padding: 12px;"
                             class="border-bottom ">
                            <div class="title">
                                <a href="{{route('post', $item->id)}}"><h6>{{$item->name}}</h6></a>
                            </div>
                            <div class="meta">
                                <small><i class="fa fa-calendar"></i> {{$item->created_at->format('d/m/yy')}}</small>
                            </div>
                            <div class="description text-muted">
                                {{$item->description}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="title">
            <h5>Nền tảng kết nối người dùng và nhà xe</h5>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row border mx-1 py-3">
                    <div class="col-md-2">
                        <img src="https://storage.googleapis.com/fe-production/images/personalize-icon.png" alt="">
                    </div>
                    <div class="col-md-10">
                        <h6>Cá nhân hóa tìm kiếm</h6>
                        <p class="text-muted">5000+ tuyến đường, 2000+ nhà xe, 5000+ đại lý trên khắp cả nước. Chọn xe
                            yêu thích cực nhanh.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row border mx-1 py-3">
                    <div class="col-md-2">
                        <img src="https://storage.googleapis.com/fe-production/images/personalize-icon.png" alt="">
                    </div>
                    <div class="col-md-10">
                        <h6>Cá nhân hóa tìm kiếm</h6>
                        <p class="text-muted">5000+ tuyến đường, 2000+ nhà xe, 5000+ đại lý trên khắp cả nước. Chọn xe
                            yêu thích cực nhanh.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row border mx-1 py-3">
                    <div class="col-md-2">
                        <img src="https://storage.googleapis.com/fe-production/images/personalize-icon.png" alt="">
                    </div>
                    <div class="col-md-10">
                        <h6>Cá nhân hóa tìm kiếm</h6>
                        <p class="text-muted">5000+ tuyến đường, 2000+ nhà xe, 5000+ đại lý trên khắp cả nước. Chọn xe
                            yêu thích cực nhanh.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://use.fontawesome.com/99348d9fc5.js"></script>
    <script src="{{asset('/vendor/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $(".owl-carousel").owlCarousel({
            dots: false,
            items: 4,
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            navigation: true,
        });

        $('.select2').select2();

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

        var _car_id = null, _price = null;

        function form_dat_ve(car_id, route = [], price, a_to_b = 1, time_start = '', starting_point = '', last_point = '') {

            time_start = time_start.split(',');
            starting_point = starting_point.split(',');
            last_point = last_point.split(',');

            console.log(starting_point);

            _car_id = car_id;
            _price = price;

            var d = new Date();
            d = d.getFullYear() + '-' + ((d.getMonth() + 1) < 10 ? '0' + (d.getMonth() + 1) : (d.getMonth() + 1)) + '-' + (d.getDate() < 10 ? '0' + d.getDate() : d.getDate());

            let html = `<input type="hidden" value="" name="car_id">
                        <input type="hidden" value="" name="a_to_b">

                        <div class="form-group">
                            <label for="name">Họ & tên:</label>
                            <input type="text"
                                   class="form-control" name="name" id="name" placeholder="Nguyễn Văn A" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Số điện thoại:</label>
                            <input type="text" class="form-control" name="phone" id="phone" aria-valuemin="10" required>
                        </div>

                        <div class="form-group">
                          <label for="a_to_b">Tuyến đường:</label>
                          <select disabled class="form-control" name="a_to_b" id="a_to_b">
                            <option value="0" ${a_to_b === 0 ? 'selected' : ''}>${route[0].value}</option>
                            <option value="1" ${a_to_b === 1 ? 'selected' : ''}>${route[1].value}</option>
                          </select>
                        </div>

                        <div class="form-group">
                            <label for="date_start">Ngày khởi hành:</label>
                            <input type="date" class="form-control" name="date_start" id="date_start" min="${d}" required>
                        </div>

                        <div class="form-group">
                            <label for="time_start">Giờ khởi hành:</label>
                            <select class="form-control" name="time_start" id="time_start" required>
                            `;
            for (let i = 0; i < time_start.length; i++) {
                html += `<option value="${time_start[i]}">${time_start[i]}</option>`;
            }
            html += `
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="starting_point">Điểm đón khách:</label>
                            <select class="form-control" name="starting_point" id="starting_point" required>
                            `;
            for (let i = 0; i < starting_point.length; i++) {
                html += `<option value="${starting_point[i]}">${starting_point[i]}</option>`;
            }
            html += `
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="last_point">Điểm trả khách:</label>
                            <select class="form-control" name="last_point" id="last_point" required>
                            `;
            for (let i = 0; i < last_point.length; i++) {
                html += `<option value="${last_point[i]}">${last_point[i]}</option>`;
            }
            html += `
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Giá vé:</label>
                            <input readonly type="text" class="form-control"
                                   value="${price.toLocaleString('it-IT', {style: 'currency', currency: 'VND'})}">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Số lượng:</label>
                            <input type="number" min="1" max="60" class="form-control" name="quantity" id="quantity"
                                   required aria-valuemin="1" aria-valuemax="60"  value="1"
                                   onchange="$('input#amount_total').val((${price} * $(this).val()).toLocaleString('it-IT', {style: 'currency', currency: 'VND'}))">
                        </div>

                        <div class="form-group">
                            <label for="amount_total">Tổng tiền:</label>
                            <input value="${(parseInt(price) * 1).toLocaleString('it-IT', {
                style: 'currency',
                currency: 'VND'
            })}" readonly type="text" class="form-control" id="amount_total">
                        </div>`;
            $('#confirm-dat-ve').html(html);
        }

        function dat_ve(e) {
            e.preventDefault();
            let quantity = $('input#quantity').val();
            let name = $('input#name').val();
            let phone = $('input#phone').val();
            let a_to_b = $('select#a_to_b').val();
            let time_start = $('select#time_start').val();
            let date_start = $('select#date_start').val();
            let starting_point = $('select#starting_point').val();
            let last_point = $('select#last_point').val();

            $.ajax({
                type: "POST",
                url: '{{route("home.book")}}',
                data: {
                    quantity,
                    name,
                    phone,
                    a_to_b,
                    car_id: _car_id,
                    _token: '{{csrf_token()}}',
                    time_start,
                    date_start,
                    starting_point,
                    last_point
                },
            }).done(function (data) {
                console.log(data);
                $('#dat-ve').modal('hide');
                alert(data);
            }).fail(function (data) {
                alert(data.responseJSON);
            });
        }

    </script>
@stop