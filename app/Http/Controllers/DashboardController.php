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
}
