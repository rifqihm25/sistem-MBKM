@extends('layouts.app')
@section('page_styles')
    <link rel="stylesheet" href="{{ url('css/stylelogin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
{{-- @section('content') --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="login-page pt-5">
        <div class="container" style="margin-top: 5%">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                <h3 class="mb-3">Login Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                <form action="{{ route('login') }}" method="POST" class="row g-4">
                                    @csrf
                                    <div class="col-12">
                                        <label class="text-white">Username<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                        <div class="input-group-text"><i class="fa-solid fa-user"></i></div>
                                        <input type="text" class="form-control @error('email')
                                        is-invalid
                                        @enderror"
                                            name="email" id="email" required value="{{ old('email') }}" placeholder="Username">
                                        {{-- <label for="name"></label> --}}
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="text-white">Password<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                        <div class="input-group-text"><i class="fa-solid fa-lock"></i></div>
                                        <input type="password"
                                            class="form-control @error('password')
                                        is-invalid
                                        @enderror"
                                            name="password" id="password" required placeholder="Password">
                                        {{-- <label for="password"></label> --}}
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                            <label class="form-check-label text-white" for="inlineFormCheck">Remember me</label>
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-6">
                                        <a href="#" class="float-end text-primary">Forgot Password?</a>
                                    </div> --}}

                                    <div class="col-12 position-relative">
                                        <button class="btn-login position-absolute top-0 start-50 translate-middle" type="submit">Login</button>
                                    </div>
                                </form>
                                </div>
                            </div>

                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 text-white text-center pt-5 position-relative">
                                    <img src="{{ url('assets/img/logo.png') }}" alt="" class="position-absolute top-50 start-50 translate-middle">
                                    {{-- <h4>Kampus Merdeka</h4> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="text-end text-secondary mt-3">Login Page MBKM</p>

                </div>
            </div>
        </div>
    </div>
    {{-- <small class="d-block mt-3">Doesn't have an account? <a class="text-danger" href="/register">
            Register
            Now!</a></small> --}}
{{-- @endsection --}}
