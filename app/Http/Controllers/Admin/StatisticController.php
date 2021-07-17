<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {

        if (Auth::user()->role === "member") {

            $charts = DB::select('SELECT MONTH(b.created_at) as thang, SUM(amount_total) as \'total\'
                FROM books b
                join cars c on c.id = b.car_id
                join brands br on br.id = c.brand_id
                WHERE br.owner = ' . Auth::id() . ' and  YEAR(b.created_at) = ' . date('Y') . '
                GROUP BY MONTH(b.created_at)');

            $data_chart = [];
            for ($i = 0; $i < 12; $i++) {
                $data_chart[] = (Object)array(
                    'thang' => $i + 1,
                    'label' => 'Tháng ' . ($i + 1),
                    'value' => 0
                );
            }

            foreach ($charts as $item) {
                array_map(function ($val) use ($item) {
                    if ($val->thang == $item->thang) $val->value = $item->total;
                }, $data_chart);
            }

            $label = implode(',', array_column($data_chart, 'label'));
            $value = implode(',', array_column($data_chart, 'value'));

            $data = DB::select('SELECT br.id, br.hotline, br.name, br.owner, br.status, u.name as \'owner_name\', u.email, u.phone, SUM(b.amount_total) as \'total\' 
                FROM books b
                JOIN cars c ON b.car_id = c.id
                JOIN brands br ON br.id = c.brand_id
                JOIN users u ON u.id = br.owner
                WHERE br.owner = ' . Auth::id() . ' and YEAR(b.created_at) = ' . date('Y') . ' and MONTH(b.created_at) = ' . date('m') . ' and DAY(b.created_at) = ' . date('d') . '
                GROUP BY br.id,br.hotline, br.name, br.owner, br.status, u.name, u.email, u.phone'
            );

        } else {
            $charts = DB::select('SELECT MONTH(b.created_at) as thang, SUM(amount_total) as \'total\'
                FROM books b
                WHERE YEAR(b.created_at) = ' . date('Y') . '
                GROUP BY MONTH(b.created_at)');

            $data_chart = [];
            for ($i = 0; $i < 12; $i++) {
                $data_chart[] = (Object)array(
                    'thang' => $i + 1,
                    'label' => 'Tháng ' . ($i + 1),
                    'value' => 0
                );
            }

            foreach ($charts as $item) {
                array_map(function ($val) use ($item) {
                    if ($val->thang == $item->thang) $val->value = $item->total;
                }, $data_chart);
            }

            $label = implode(',', array_column($data_chart, 'label'));
            $value = implode(',', array_column($data_chart, 'value'));

            $data = DB::select('SELECT br.id, br.hotline, br.name, br.owner, br.status, u.name as \'owner_name\', u.email, u.phone, SUM(b.amount_total) as \'total\' 
                FROM books b
                JOIN cars c ON b.car_id = c.id
                JOIN brands br ON br.id = c.brand_id
                JOIN users u ON u.id = br.owner
                WHERE YEAR(b.created_at) = ' . date('Y') . ' and MONTH(b.created_at) = ' . date('m') . ' and DAY(b.created_at) = ' . date('d') . '
                GROUP BY br.id,br.hotline, br.name, br.owner, br.status, u.name, u.email, u.phone'
            );
        }
        return view('admin.statistic.index', compact('data', 'label', 'value'));
    }
}
