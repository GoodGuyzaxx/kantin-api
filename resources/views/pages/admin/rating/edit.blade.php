@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 border-bottom">
        <h1 class="mt-4 h2">Edit Rating  {{ $data->nama_konsumen }}</h1>
    </div>

    <form class="col-lg-8 container-fluid px-4 mt-3" method="POST" action="{{ route('admin.rating.update', $data->id) }}"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select class="form-select @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                <option value="">Pilih Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ (old('rating', $data->rating) == $i) ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>

            @error('rating')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
        <a href="{{ route('admin.rating.index') }}" class="btn btn-danger mb-3">Cancel</a>
    </form>
@endsection
