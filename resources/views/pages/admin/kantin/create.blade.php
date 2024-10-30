@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">Tambah Admin Kantin</h1>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('admin.kantin.register') }}">
        @method('post')
        @csrf
        <div class="mb-3">
            <label for="nama_kantin" class="form-label">Nama Kantin</label>
            <input type="text" class="form-control @error('nama_kantin') is-invalid @enderror" id="nama_kantin" name="nama_kantin"
                   value="{{ old('nama_kantin') }}" autofocus required placeholder="Masukan nama kantin">

            @error('nama_kantin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id_admin" class="form-label">Daftar Admin</label>
            <select class="form-select @error('level') is-invalid @enderror" id="id_admin" name="id_admin" required>
                <option value="" disabled selected>Choose One</option>
                @foreach($kantins as $kantin)
                    <option value="{{$kantin->id_admin}}" {{ old('id_admin') }}>{{$kantin->id_admin}}:{{$kantin->nama_admin}}</option>
                @endforeach
            </select>

            @error('id_admin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary mb-3">Save</button>
        <a href="{{ route('admin.kantin.index') }}" class="btn btn-danger mb-3">Cancel</a>
    </form>
@endsection
