<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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


    //CART
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
        
        Log::info('Cart SEBELUM:', $cart);


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
        Log::info('Cart SESUDAH:', $cart);

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


    // CHECKOUT
    public function checkout_view(){
        $cart = Session::get('cart', []);
        $tableNumber = Session::get('tableNumber', null);

        if(empty($cart)){
            return redirect()->route('menu.cart');
        }
        return view('customer.checkout', compact('cart', 'tableNumber'));
    }

    public function checkout_store(Request $request){
        $cart = Session::get('cart', []);
        $tableNumber = Session::get('tableNumber', null);

        if(empty($cart)){
            return redirect()->route('menu.cart')->with('message', 'Keranjang kosong, silahkan tambah menu terlebih dahulu.');
        }

        $request->validate([
            'fullname' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|string|in:qris,tunai',
        ]);

        $totalAmount = 0;
        foreach($cart as $item){
            $totalAmount += $item['price'] * $item['qty'];

            $itemDetails[] = [
                'id' => $item['id'],
                'name' => substr($item['name'], 0, 100),
                'price' => (int) ($item['price'] + ($item['price'] * 0.1)),
                'quantity' => $item['qty'],
            ];
        }

        $user = User::firstOrCreate([
            'fullname' => $request->input('fullname'),
            'phone' => $request->input('no_tlp'),
            'username' => 'guest_'. $request->input('fullname'). time(),
            'role_id' => 4,
            'email' => 'guest_'. time(). '@example.com',
            'password' => bcrypt('password123'),
        ]);

        $order = Order::create([
            'order_code' => 'ORD' . '-'. time(). '-'. $user->id,
            'user_id' => $user->id,
            'subtotal' => $totalAmount,
            'tax' => $totalAmount * 0.1,
            'grand_total' => $totalAmount + ($totalAmount * 0.1),
            'status' => 'pending',
            'table_number' => $tableNumber,
            'payment_method' => $request->input('payment_method'),
            'notes' => $request->input('notes'),
        ]);

        foreach($cart as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['id'],
                'price' => $item['price'],
                'tax' => ($item['price'] + $item['qty']) * 0.1,
                'total_price' => ($item['price'] + ($item['price'] * 0.1)) * $item['qty'],
                'quantity' => $item['qty'],
            ]);
        }

        Session::forget('cart');
        if($order->payment_method == 'tunai'){
            return redirect()->route('menu.success', ['orderId' => $order->order_code])->with('success', 'Pesanan berhasil dibuat! Terima kasih telah memesan.');
        }else{
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' =>[
                    'order_id' => $order->order_code,
                    'gross_amount' => (int) $order->grand_total,
                ],
                'item_details' => $itemDetails,
                'customer_details' => [
                    'fullname' => $user->fullname ?? 'Guest',
                    'phone' => $user->phone,
                ],
                'payment_type' => 'qris',
            ];

            try{
                $snapToken = \Midtrans\Snap::getSnapToken($params);

                return response()->json([
                    'status' => 'success',
                    'snap_token' => $snapToken,
                    'order_code' => $order->order_code,
                ], 200);
            }catch(\Exception $e){
                Log::error('Midtrans Snap Token Error: ' . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mendapatkan membuat pesanan. Silahkan coba lagi.',
                ], 500);

            }
        }
    }

    public function success($orderId){

        $order = Order::where('order_code', $orderId)->latest()->first();
        if(!$order){
            return redirect()->route('menu')->with('error', 'Pesanan tidak ditemukan.');
        }
        $orderItems = OrderItem::with('item')->where('order_id', $order->id)->get();

        if ($order->payment_method === 'qris' && $order->status !== 'settlement') {
            $order->update([
                'status' => 'settlement'
            ]);
        }

        return view('customer.success', compact('order', 'orderItems'));
    }
}
