@extends('admin.layouts.dashboard')

@section('content')
<div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Role Page</h3>
        </div> 
        <div id="main w-full"> 
            <div class="page-heading">
            <div class="page-title">
                <div class="row">                    
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Role Table</h3>
                        <p class="text-subtitle text-muted">Handle Role</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">Role</a></li>
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
                            Data Role
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="d-flex">
                                        <a href="{{ route('roles.index') }}" class="btn btn-primary mb-3 ms-auto">Back</a>
                                    </div>
                                <div class="card-header">
                                    <h4 class="card-title">New Role</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Role Name</h6></label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}">
                                                @error('name')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Description</h6></label>
                                                <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $role->description) }}">
                                                @error('description')
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