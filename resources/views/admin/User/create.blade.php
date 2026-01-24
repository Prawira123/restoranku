@extends('admin.layouts.dashboard')

@section('content')
<div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>User Page</h3>
        </div> 
        <div id="main w-full"> 
            <div class="page-heading">
            <div class="page-title">
                <div class="row">                    
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>User Table</h3>
                        <p class="text-subtitle text-muted">Handle User</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="">User</a></li>
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
                            Data User
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="post" >
                            @csrf
                            <div class="card">
                                <div class="d-flex">
                                        <a href="{{ route('users.index') }}" class="btn btn-primary mb-3 ms-auto">Back</a>
                                    </div>
                                <div class="card-header">
                                    <h4 class="card-title">New User</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Username</h6></label>
                                                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                                                @error('username')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Fullname</h6></label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                                                @error('fullname')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <h6>Roles</h6>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="role_id">
                                                        <option value="" selected disabled>Choose Role</option>
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>                                             
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                                @error('role_id')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Email</h6></label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                                @error('email')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Password</h6></label>
                                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                                                @error('password')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Password Confimation</h6></label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                                                @error('password_confirmation')
                                                <div class="text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form_barang" >
                                                <label for="helperText"><h6>Phone</h6></label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                                                @error('phone')
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