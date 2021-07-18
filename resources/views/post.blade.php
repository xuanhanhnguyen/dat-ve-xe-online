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
        <form class="position-relative d-inline-flex justify-content-center align-items-center" action="/search">
            <select name="station_a" class="form-control w-auto select2">
                <option value="">Chọn</option>
                @foreach($places as $key => $item)
                    <optgroup label="{{\App\Place::GROUP[$key]}}">
                        @foreach($item as $_item)
                            <option value="{{$_item->id}}"
                                    @if(isset($_GET['station_a']) && $_item->id == $_GET['station_a']) selected @endif>{{$_item->name}}</option>
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
                                    @if(isset($_GET['station_b']) && $_item->id == $_GET['station_b']) selected @endif>{{$_item->name}}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>

            <button id="btn-search" class="btn btn-warning">Tìm chuyến</button>
        </form>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="tex-center">
                    <h5 class="text-primary">{{$data->name}}</h5>
                </div>

                <div class="meta">
                    <small><i class="fa fa-calendar"></i> {{$data->created_at->format('d/m/yy')}}</small>
                </div>

                <div class="content">
                    {!! $data->content !!}
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <!--post like-->
                <div class="fb-like"
                     data-href="http://fgc.vn/test-fb"
                     data-layout="standard" data-action="like"
                     data-size="small"
                     data-share="true"
                     data-width="720"
                     data-show-faces="true">
                </div>
                <!--post comment-->
                <div class="fb-comments"
                     data-href="http://fgc.vn/test-fb"
                     data-numposts="5"
                     data-width="100%">
                </div>
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

    </script>
@stop