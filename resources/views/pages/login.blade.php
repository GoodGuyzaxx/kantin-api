@extends('layouts.login')

@section('title')
    Login
@endsection

@section('content')
    <!-- ======= main ======= -->
    <section class="my-login-page">
        <div class="container form-Bg">
            <div class="row justify-content-md-center">
                <div class="card-wrapper">
                    <div class="card fat">
                        <div class="card-body">
                            {{-- login --}}
                            <h4 class="card-title text-center">Login</h4>
                            <form action="{{ route('login.index') }}" method="POST" class="my-login-validation"
                                  novalidate="">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="text"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="" required autofocus placeholder="Input email" />
                                    <div class="invalid-feedback">Email is invalid</div>
                                </div>

                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password </label>
                                    <input id="password" type="password"
                                           class="form-control  @error('password') is-invalid @enderror" name="password"
                                           required data-eye placeholder="Input password" />
                                    <div class="invalid-feedback">Password is required</div>
                                </div>

                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="m-0 d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>

                                </div>
                                <a href="/" class="btn btn-secondary px-3 mb-2  mt-2 mb-lg-0 text-decoration-none">
                                            <span class="d-flex align-items-center">
                                                <span class="small">Home</span>
                                            </span>
                                </a>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
