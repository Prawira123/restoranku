@extends('customer.layouts.master')
<!-- Single Page Header start -->
@section('content')
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Keranjang</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item active text-primary">Silakan periksa pesanan anda</li>
        </ol>
    </div>
    @if(session('success'))
        <div class="alert alert-success justify-content-between" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif  
    @if(empty($cart))
        <h5 class="text-center items-center mt-4 text-danger">Keranjang Anda kosong. Silakan tambahkan item ke keranjang Anda.</h5>
    @else
    <!-- Single Page Header End -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Total</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subTotal = 0;
                        @endphp

                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('menu.cart.clear') }}" class="btn btn-danger" onclick="return confirm('Apakah yakin untuk menghapus semua Menu di keranjang ini?');">Kosongkan Keranjang</a>
                        </div>
                        @foreach ( $cart as $item )                        
                        @php
                            $itemTotal = $item['price'] * $item['qty'];
                        @endphp
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset(path: 'img_item_upload/'.$item['img']) }}" class="img-fluid rounded-circle" style="width: 100px; height: 90px; object-fit: cover;" alt="" onerror="this.onerror=null;this.src='{{ $item['img'] }}'">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp.{{ number_format($item['price'], 2, ',', '.') }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="updateQuantity({{ $item['id'] }}, -1)" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="qty-{{ $item['id'] }}" class="form-control form-control-sm text-center border-0 bg-transparent" value="{{ $item['qty'] }}" readonly>
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="updateQuantity({{ $item['id'] }}, +1)">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp.{{ number_format($itemTotal, 2, ',', '.') }}</p>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-md rounded-circle bg-light border mt-4" onclick="if(confirm('Apakah anda yakin untuk menghapus menu ini dari cart?')) {removeItemFromCart({{ $item['id'] }}); }">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @php
                            $subTotal += $itemTotal;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end mt-1">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h2 class="display-6 mb-4">Total <span class="fw-normal">Pesanan</span></h2>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal</h5>
                                <p class="mb-0">Rp.{{ number_format($subTotal, 2, ',', '.') }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-0 me-4">Pajak (10%)</p>
                                <div class="">
                                    <p class="mb-0">Rp.{{ number_format($subTotal * 0.1, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top d-flex justify-content-between">
                            <h4 class="mb-0 ps-4 me-4">Total</h4>
                            <h5 class="mb-0 pe-4">Rp{{ number_format($subTotal + ($subTotal * 0.1), 2, ',', '.') }}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="mb-0 mb-3">
                            <a href="{{ route('menu.checkout') }}" class="btn border-secondary py-3 text-primary text-uppercase mb-4" type="button">Lanjut ke Pembayaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('script')
    <script>
        function updateQuantity(itemId, change){
            var qtyInput = document.getElementById('qty-' + itemId);
            var currentQty = parseInt(qtyInput.value);
            var newQty = currentQty + change;

            if(newQty < 1){
                if(confirm('Apakah anda yakin untuk menghapus menu ini dari cart?')){
                    removeItemFromCart(itemId);
                }
                return;
            }

            fetch("{{ route('menu.cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    id: itemId,
                    qty: newQty
                })
            })
            .then(response =>response.json())
            .then(data => {
                if(data.success){
                    qtyInput.value = newQty;
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
        }

        function removeItemFromCart(itemId){
            fetch("{{ route('menu.cart.delete') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    id: itemId,
                })
            })
            .then(response =>response.json())
            .then(data => {
                if(data.success){
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        }
    </script>
@endsection