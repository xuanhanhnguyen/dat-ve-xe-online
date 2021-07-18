<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>vexere.com</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    @yield('css')
</head>
<body>
<header>
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light">
            <a class="navbar-brand" href="/">
                <img src="https://storage.googleapis.com/fe-production/icon_vxr_full.svg" alt="">
            </a>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        VN <img src="https://storage.googleapis.com/fe-production/images/vietnam_icon.png" alt="">
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer>
    <div class="text-center py-4 mt-4">
        <h5>Công ty TNHH Thương Mại Dịch Vụ VeXeRe</h5>
        <p>Bản quyền © 2020 thuộc về VeXeRe.Com</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
    $('#btn-switch').click(function () {
        let a = $('select[name=station_a]');
        let b = $('select[name=station_b]');

        let v_a = a.val();
        let v_b = b.val();

        a.val(v_b).trigger('change');
        b.val(v_a).trigger('change');
    })
</script>
@yield('js')
</body>
</html>
