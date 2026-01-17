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
                    <div class="card-body">
                        <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="d-flex">
                                        <a href="{{ route('items.index') }}" class="btn btn-primary mb-3 ms-auto">Back</a>
                                    </div>
                                <div class="card-header">
                                    <h4 class="card-title">New Menu</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Menu Name</h6></label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                                @error('name')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Description</h6></label>
                                                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">
                                                @error('description')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Price</h6></label>
                                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
                                                @error('price')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Image</h6></label>
                                                <input type="file" class="form-control" id="img" name="img">
                                                @error('img')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Category</h6>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="category_id">
                                                        <option value="" selected disabled>Choose Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->cat_name }}</option>                                             
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                @error('category_id')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Status</h6>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="is_active">
                                                        <option value="" selected disabled>Choose Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                </fieldset>
                                                @error('is_active')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>                    
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2 card">
                                    <button type="submit" name="action" class="btn btn-success btn-md w-[200px]">Submit</button>
                                </div>                    
                            </div>
                        </form>
                        
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