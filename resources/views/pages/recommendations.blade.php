@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Menu Rekomendasi untuk Anda</h1>

        @if($recommendedMenus->count() > 0)
            <div class="row">
                @foreach($recommendedMenus as $menu)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if($menu->gambar)
                                <img src="{{ asset('storage/gambar/' . $menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama_menu }}" style="height: 200px; width: 100%; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span>Tidak ada gambar</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                                <p class="card-title">ID Kantin {{ $menu->id_kantin }}</p>
                                <p class="card-text">{{ Str::limit($menu->deskripsi, 100) }}</p>
                                <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                <p class="card-title">Rata-rata = {{ $menu->predicted_rating }}</p>
{{--                                <a href="{{ route('menus.show', $menu->id) }}" class="btn btn-primary">Lihat Detail</a>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                Maaf, saat ini kami belum memiliki rekomendasi menu untuk Anda. Cobalah untuk memberikan rating pada beberapa menu terlebih dahulu.
            </div>
        @endif
    </div>
@endsection
