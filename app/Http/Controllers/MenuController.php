<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index(){

        $tableNumber = request()->query('meja');

        if($tableNumber){
            Session::put('tableNumber', $tableNumber); 
        }

        $menus = Item::with('category')->where('is_active', true)->get();
        return view('customer.menu', compact('menus', 'tableNumber'));
    }

    public function cart_view(){
        $cart = Session::get('cart', []);
        return view('customer.cart', compact('cart'));
    }

    public function addToCart(Request $request){
        $menuId = $request->input('id');
        $menu = Item::find($menuId);

        if(!$menu){
            return response()->json(['message' => 'Menu tidak ditemukan'], 404);
        }

        $cart = Session::get('cart', []);

        if(isset($cart[$menuId])){
            $cart[$menuId]['qty'] += 1;
        }else{
            $cart[$menuId] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'qty' => 1,
                'img' => $menu->img,
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu berhasil ditambahakn kedalam Keranjang',
            'cart' => $cart
        ]);

    }

    public function updateCart(Request $request){
        $menuId = $request->input('id');
        $qty = $request->input('qty');

        if($qty <= 0){
            return response()->json(['success' => false, 'message' => 'Kuantitas harus lebih dari 0'], 400);
        }

        $cart = Session::get('cart', []);

        if(isset($cart[$menuId])){
            $cart[$menuId]['qty'] = $qty;
            Session::put('cart', $cart);
            Session::flash('success', 'Keranjang berhasil diperbarui');

            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui',
            ]);
        }

        
        return response()->json([
            'success' => false,
            'message' => 'Menu tidak ditemukan di keranjang',
        ]);
    }

    public function removeCart(){
     $menuId = request()->input('id');
     $cart = Session::get('cart', []);
     
     if(isset($cart[$menuId])){
        unset($cart[$menuId]);
        Session::put('cart', $cart);
        Session::flash('success', 'Menu berhasil dihapus dari keranjang');

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus dari keranjang',
        ]);

    }
    return response()->json([
        'success' => false,
        'message' => 'Menu tidak ditemukan di keranjang',
    ]);
    }

    public function clearCart(){
        Session::forget('cart');
        Session::flash('success', 'Semua menu berhasil dihapus dari keranjang');
        return redirect()->route('menu.cart');
    }

    public function checkout_view(){
        return view('customer.checkout');
    }
}
