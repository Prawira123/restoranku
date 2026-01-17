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
                        <h3>Order Table</h3>
                        <p class="text-subtitle text-muted">Handle Order</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Order</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Data Order
                        </h5>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex">
                            <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3 ms-auto"> New Order</a>
                        </div>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>User Fullname</th>
                                    <th>Order Code</th>
                                    <th>Sub Total</th>
                                    <th>Tax</th>
                                    <th>Grand Total</th>
                                    <th>Table Number</th>
                                    <th>Payment Method</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order )
                                    <tr>
                                    <td >{{ $order->user->fullname }}</td>
                                    <td >{{ $order->order_code }}</td>
                                    <td >{{ number_format($order->sub_total, 2, ',', '.' )}}</td>
                                    <td >{{ number_format($order->tax, 2, ',', '.' )}}</td>
                                    <td >{{ number_format($order->grand_total, 2, ',', '.' )}}</td>
                                    <td >{{ $order->table_number }}</td>
                                    <td >{{ $order->payment_method }}</td>
                                    <td >{{ $order->notes ?? '-' }}</td>
                                    @if($order->status == 'pending')
                                        <td ><span class="badge text-danger">{{ $order->status }}</span></td>
                                    @elseif($order->status == 'settlement')
                                        <td ><span class="badge text-success">{{ $order->status }}</span></td>
                                    @else
                                        <td ><span class="badge text-warning">{{ $order->status }}</span></td>
                                    @endif
                                    <td class="d-flex gap-2 flex-wrap">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success btn-sm">Change Status</a>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="post" class="d-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin untuk menghapus data Order ini?')" class="btn btn-danger btn-sm">Delete</button>
                                        </form>                                
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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