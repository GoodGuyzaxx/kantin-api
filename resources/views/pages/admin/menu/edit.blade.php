@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">Edit Menu {{ $data->nama_menu }}</h1>
    </div>

    <form class="col-lg-8 container-fluid px-4 mt-3" method="POST" action="{{ route('admin.menu.update', $data->id_menu) }}" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="mb-3">
            <label for="nama_kantin" class="form-label">Nama Kantin</label>
            <input type="text" readonly class="form-control-plaintext @error('nama_kantin') is-invalid @enderror" id="nama_kantin" name="nama_kantin" value="{{ old('nama_kantin', $data->nama_kantin) }}" required>
            @error('nama_kantin')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control @error('nama_menu') is-invalid @enderror" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $data->nama_menu) }}" required>
            @error('nama_menu')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $data->deskripsi) }}</textarea>
            @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $data->harga) }}" required>
            @error('harga')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Gambar</label>
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="file" name="file">
            @if($data->gambar)
                <div class="mt-2">
                    <img src="{{ asset('storage/gambar/' . $data->gambar) }}" alt="{{ $data->nama_menu }}" style="max-width: 200px;">
                </div>
            @endif
            @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $data->stock) }}" required>
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="makanan" {{ (old('kategori', $data->kategori) == 'makanan') ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ (old('kategori', $data->kategori) == 'minuman') ? 'selected' : '' }}>Minuman</option>
                <!-- Add more categories as needed -->
            </select>
            @error('kategori')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
        <a href="{{ route('admin.menu.index') }}" class="btn btn-danger mb-3">Cancel</a>
    </form>
@endsection
