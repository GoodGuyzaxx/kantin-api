@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">Buat Akun Admin</h1>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div class="mb-3">
            <label for="nama_admin" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('nama_admin') is-invalid @enderror" id="nama_admin" name="nama_admin"
                value="{{ old('nama_admin') }}" autofocus required placeholder="Masukan nama lengkap">

            @error('nama_admin')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="no_telp" class="form-label">Nomor Telephone</label>
            <input type="text" class="form-control @error('notelp') is-invalid @enderror" id="no_telp"
                name="no_telp" value="{{ old('no_telp') }}" required placeholder="Masukan Nomor Telephone">

            @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" required placeholder="example@example.com">

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" value="{{ old('password') }}" required placeholder="masukan password" aria-describedby="basic-addon2">
                <div class="align-items-center">
                    <span class="input-group-text" id="basic-addon2">
                        <i class="fa-solid fa-eye-slash pointer" id="hide" onclick="myFunction()"></i>
                        &nbsp
                        <i class="fa-solid fa-eye pointer" id="show" onclick="myFunction()"></i>
                    </span>
                </div>
            </div>

            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Save</button>
        <a href="{{ route('admin.user.index') }}" class="btn btn-danger mb-3">Cancel</a>
    </form>
@endsection
