@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">Daftar Menu</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                    <li class="breadcrumb-item active">{{ $data->first()->nama_konsumen ?? 'Konsumen' }}</li>
                </ol>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body table-responsive">
                <form action="{{ url()->current() }}" method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="month" class="form-select">
                                <option value="">Pilih Bulan</option>
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                    <div class="col-md-5 mb-4 mt-4">
                        <a href="{{ route('admin.transaksi.konsumen.export', ['nama' => request()->route('nama'), 'month' => request('month')]) }}" class="btn btn-success">Download Laporan</a>
                    </div>
                </form>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table id="datatablesSimple" class="table table-bordered">
                    <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>ID Order</th>
                        <th>Nama Kantin</th>
                        <th>Harga</th>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Status Pesanana</th>
                        <th>Jenis Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Order</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($data->count())
                        @foreach ($data as $riwayat)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $riwayat->id_order }}</td>
                                <td class="text-center">{{ $riwayat->nama_kantin }}</td>
                                <td class="text-center">{{ $riwayat->total_harga }}</td>
                                <td class="text-center">{{ $riwayat->menu }}</td>
                                <td class="text-center">{{ $riwayat->jumlah }}</td>
                                <td class="text-center">{{ $riwayat->status_pesanan }}</td>
                                <td class="text-center">{{ $riwayat->tipe_pembayaran }}</td>
                                <td class="text-center">{{ $riwayat->status_pembayaran }}</td>
                                <td class="text-center">{{ $riwayat->created_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-danger text-center p-4">
                                <h4>Data Tidak ditemukan</h4>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
