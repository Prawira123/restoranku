<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $menus = Item::with('category')->where('is_active', true)->get();
        return view('customer.menu', compact('menus'));
    }

    public function cart_view(){
        return view('customer.cart');
    }

    public function checkout_view(){
        return view('customer.checkout');
    }
}
