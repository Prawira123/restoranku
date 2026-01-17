@extends('admin.layouts.dashboard')

@section('content')
<div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Menu Page</h3>
        </div> 
        <div id="main w-full"> 
            <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 col-lg-6 col-md-6">
                                <div class="card"> 
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Banyak Menu Active</h6>
                                                <h6 class="font-extrabold mb-0">{{ $menus->where('is_active', true)->count() }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-6 col-md-6">
                                <div class="card"> 
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Banyak Menu In active</h6>
                                                <h6 class="font-extrabold mb-0">{{ $menus->where('is_active', false)->count() }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Menu Table</h3>
                        <p class="text-subtitle text-muted">Handle Menu</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Menu</a></li>
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
                            Data Menu
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
                            <a href="{{ route('items.create') }}" class="btn btn-primary mb-3 ms-auto"> New Menu</a>
                        </div>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>Menu name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $item )
                                    <tr>
                                    <td >{{ $item->name }}</td>
                                    <td >{{ Str::limit($item->description, 50, '...') }}</td>
                                    <td >Rp.{{ number_format($item->price, 2, ',', '.' )}}</td>
                                    <td >{{ $item->category->cat_name }}</td>
                                    <td >
                                        @if($item->img)
                                            <img src="{{ asset(path: 'img_item_upload/'.$item->img) }}" class="img-fluid" style="width: 100px; height: 90px; object-fit: cover;" alt="" onerror="this.onerror=null;this.src='{{ $item->img }}'">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td >
                                        @if($item->is_active)
                                            <span class="badge text-success">Active</span>
                                        @else
                                            <span class="badge text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="d-flex gap-2 flex-wrap">
                                        <form action="{{ route('items.status.change', $item->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Change Status</button>
                                        </form>
                                        <a href="{{ route('items.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('items.destroy', $item->id) }}" method="post" class="d-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin untuk menghapus data Item ini?')" class="btn btn-danger btn-sm">Delete</button>
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