@extends('customer.layouts.master')

@section('content')
            <!-- Single Page Header start -->
            <div class="container-fluid page-header py-5">
                <h1 class="text-center text-white display-6">Menu Kami</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item active text-primary">Silakan pilih menu favorit anda</li>
                </ol>
            </div>
            <!-- Single Page Header End -->
            @if(session('success'))
                <div class="alert alert-success justify-content-between" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-3">
                            <div class="col-lg">
                                <div class="row g-4 justify-content-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex justify-content-start align-items-center gap-2">
                                            <div class="">
                                                <a href="{{ route('menu') }}" 
                                                class="btn {{ request()->has('makanan') ? 'btn-secondary' : 'btn-primary' }} text-white">
                                                All
                                                </a>

                                                <a href="{{ route('menu', ['makanan' => 1]) }} text-white" 
                                                class="btn {{ request('makanan') == 1 ? 'btn-primary' : 'btn-secondary' }} text-white">
                                                Makanan
                                                </a>

                                                <a href="{{ route('menu', ['makanan' => 2]) }}" 
                                                class="btn {{ request('makanan') == 2 ? 'btn-primary' : 'btn-secondary' }} text-white">
                                                Minuman
                                                </a>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start align-items-center gap-2">
                                            <form action="{{ route('menu') }}" method="get" class="d-flex justify-content-start align-items-center gap-2">
                                                <input type="text" name="search" class="form-control" placeholder="mau pesen apa...">
                                                <button class="btn btn-primary text-white" type="submit">Cari</button>
                                            </form>
                                        </div>
                                    </div>
                                        <x-card-menu :menus="$menus" />
                                    <!-- Pagination -->
                                    <!-- <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <a href="#" class="rounded">&laquo;</a>
                                            <a href="#" class="active rounded">1</a>
                                            <a href="#" class="rounded">2</a>
                                            <a href="#" class="rounded">3</a>
                                            <a href="#" class="rounded">4</a>
                                            <a href="#" class="rounded">5</a>
                                            <a href="#" class="rounded">6</a>
                                            <a href="#" class="rounded">&raquo;</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        function addToCart(menuId){
            fetch("{{ route('menu.cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    id: menuId
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
@endsection