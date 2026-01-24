@extends('admin.layouts.dashboard')

@section('content')
<div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Category Page</h3>
        </div> 
        <div id="main w-full"> 
            <div class="page-heading">
            <div class="page-title">
                <div class="row">                    
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Category</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Index</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <h6>Category Name : <span class="text-info">{{ $category->cat_name }}</span></h6>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <h6>Description : <span class="text-info">{{ $category->description }}</span></h6>
                    </div>
                    <div class="card-body d-flex justify-content-between">
                        <h6>Exist : <span class="text-info">{{ \Carbon\Carbon::parse($category->created_at)->format('d F Y') }}</span></h6>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
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


               
               
               
               
