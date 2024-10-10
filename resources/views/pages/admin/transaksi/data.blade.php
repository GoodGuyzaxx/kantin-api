@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">List Transaksi</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>

        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body table-responsive">
{{--                <div class="d-sm-flex align-items-center justify-content-between">--}}
{{--                    <a href="{{ route('admin.konsumen.create') }}" type="button" class="btn btn-primary mb-3"><i--}}
{{--                            class="fas fa-plus me-1"></i>Menu</a>--}}
{{--                </div>--}}

                {{-- validate req field --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- file request --}}
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
                            <th>Nama Pemesanan</th>
                            <th>Tanggal Order</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data ->count())
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
                                    <td class="text-center">{{ $riwayat->nama_konsumen }}</td>
                                    <td class="text-center">{{ $riwayat->created_at }}</td>
                                    <td class="text-center">
                                        <form action="{{route('admin.transaksi.delete', $riwayat->id)}}" method="POST"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="badge bg-danger border-0 btnDelete" data-object="admins"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-danger text-center p-4">
                                    <h4>Data TIdak di temukan</h4>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
