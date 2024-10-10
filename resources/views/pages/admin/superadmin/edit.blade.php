@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">Edit data </h1>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('admin.super.update', ['id' => $data->id]) }}"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $data->name) }}" autofocus required placeholder="Masukan nama lengkap">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email', $data->email) }}" required placeholder="example@example.com">

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="myInput"
                    name="password" placeholder="masukan password" aria-describedby="basic-addon2">
                <div class="align-items-center">
                    <span class="input-group-text" id="basic-addon2">
                        <i class="fa-solid fa-eye-slash pointer" id="hide" onclick="myFunction()"></i>
                        &nbsp
                        <i class="fa-solid fa-eye pointer" id="show" onclick="myFunction()"></i>
                    </span>
                </div>
            </div>

            @error('password')
                <div class="text-danger">
                    <small>{{ $message }}</small>
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-danger mb-3">Cancel</a>
    </form>
@endsection
