@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">Update Akun Admin</h1>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('admin.kantin.update', $data->id_kantin) }}">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="nama_kantin" class="form-label">Nama Kantin</label>
            <input type="text" class="form-control @error('nama_kantin') is-invalid @enderror" id="nama_kantin" name="nama_kantin"
                   value="{{ old('nama_kantin', $data->nama_kantin) }}" autofocus required placeholder="Masukan nama kantin">

            @error('nama_kantin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Save</button>
        <a href="{{ route('admin.kantin.index') }}" class="btn btn-danger mb-3">Cancel</a>
    </form>
@endsection
