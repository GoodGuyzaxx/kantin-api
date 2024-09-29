@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">Tambah Kategori</h1>
    </div>

    <form class="col-lg-8 contianer-fluid px-4 mt-3" method="POST" action="{{ route('admin.kategori.create') }}">
        @csrf
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori"
                value="{{ old('kategori') }}" autofocus required placeholder="Masukan kategori menu">

            @error('kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Save</button>
        <a href="{{ route('admin.kategori.show') }}" class="btn btn-secondary mb-3">Lihat Kategori</a>

    </form>
@endsection
