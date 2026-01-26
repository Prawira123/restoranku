<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $pesanan = Order::count();
        $totalPendapatan = Order::sum('grand_total');
        $menu = Item::count();
        $karyawan = User::where('role_id', '!=', 4)->count();

        return view('admin.dashboard.index', compact('pesanan', 'totalPendapatan', 'menu', 'karyawan'));
    }

    public function penjualan_perbulan(){

        $data = Order::selectRaw(
            'YEAR(created_at) as year, MONTH(created_at) as month, SUM(grand_total) as total'
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get();

        $labels = [];
        $totals = [];

        foreach($data as $item){
            $labels [] = date('F Y', mktime(0, 0, 0, $item->month, 1, $item->year));
            $totals [] = $item->total;
        }

        return response()->json([
            'data' => $totals,
            'labels' => $labels,
        ]);
    }
}
