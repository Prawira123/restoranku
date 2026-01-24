@extends('admin.layouts.dashboard')

@section('content')
<div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Order Page</h3>
        </div> 
        <div id="main w-full"> 
            <div class="page-heading">
            <div class="page-title">
                <div class="row">                    
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>{{ $order->order_code }}</h3>
                        <h5>Table : {{ $order->table_number }}</h5>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Order</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h6>User : <span class="text-info">{{ $order->user->fullname }}</span></h6>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <h6>Sub total : <span class="text-info">{{ number_format($order->subtotal, 2, ',', '.') }}</span></h6>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <h6>Tax : <span class="text-info">{{ number_format($order->tax, 2, ',', '.') }}</span></h6>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <h6>Grand Total : <span class="text-info">{{ number_format($order->grand_total, 2, ',', '.') }}</span></h6>
                    </div>
                     @if($order->status == 'pending')
                        <div class="card-body d-flex justify-content-between">
                            <h6>Status : <span class="text-info">Pending</span></h6>
                        </div>
                    @else
                        <div class="card-body d-flex justify-content-between">
                            <h6>Status : <span class="text-info">Settlement</span></h6>
                        </div>
                    @endif
                    <div class="card-body d-flex justify-content-between">
                        <h6>Notes : <span class="text-info">{{ $order->notes }}</span></h6>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <h6>Order Created : <span class="text-info">{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y') }}</span></h6>
                    </div>
                </div>
                <h3>Order Items</h3>
                <div class="card">
                    @foreach ($order_items as $item)
                        <div class="card-body d-flex justify-content-between">
                            <h6>Menu : <span class="text-info">{{ $item->item->name }}</span></h6>
                            <h6>Qty : <span class="text-info">{{ $item->quantity }}</span></h6>
                            <h6>Price : <span class="text-info">{{ $item->price }}</span></h6>
                            <h6>Tax : <span class="text-info">{{ $item->tax }}</span></h6>
                            <h6>Total Price : <span class="text-info">{{ $item->total_price }}</span></h6>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
                    </div>
        </section>
            </div>
        </div>
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                        by <a href="https://saugi.me">Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection


               
               
               
               
