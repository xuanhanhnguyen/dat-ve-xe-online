@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Thống kê doanh thu</h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Thống kê doanh thu</li>
    </ol>
@stop

@section('css')
    <!-- Morris charts -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/vendor/morris.js/morris.css')}}">
@stop

@section('content')
    <!-- BAR CHART -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Doanh thu theo tháng của năm hiện tại</h3>
        </div>
        <div class="box-body">
            <div class="chart">
                <canvas id="barChart" style="height:400px"></canvas>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <h4>Doanh thu các hãng xe trong hôm nay</h4>
    <div class="box box-primary p-3">
        <table id="data-table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Hãng xe</th>
                <th>Hotline</th>
                <th>Người quản lý</th>
                <th>Trạng thái</th>
                <th>Doanh thu</th>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>

                        <ul>
                            @foreach(explode(',', $item->hotline) as $phone)
                                <li>{{$phone}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li>{{$item->owner_name}}</li>
                            <li>{{$item->email}}</li>
                            <li>{{$item->phone}}</li>
                        </ul>
                    </td>
                    <td>{{\App\Brand::STATUS[$item->status]}}</td>
                    <td>
                        {{_price($item->total)}}
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
    <!-- Morris.js charts -->
    <script src="{{asset('vendor/adminlte/vendor/chart.js/Chart.js')}}"></script>
    <script>

        var label = '{{$label}}'.split(',');
        var value = '{{$value}}'.split(',');

        var areaChartData = {
            labels: label,
            datasets: [

                {
                    label: 'Digital Goods',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: value
                }
            ]
        }
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d');
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        var barChartOptions = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: true,
            //String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - If there is a stroke on each bar
            barShowStroke: true,
            //Number - Pixel width of the bar stroke
            barStrokeWidth: 2,
            //Number - Spacing between each of the X value sets
            barValueSpacing: 15,
            //Number - Spacing between data sets within X values
            barDatasetSpacing: 1,
            //String - A legend template
            //Boolean - whether to make the chart responsive
            responsive: true,
            maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
    </script>
@stop
