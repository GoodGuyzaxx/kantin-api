@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">Daftar Kantin</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>

        {{-- datatable --}}
        <div class="card mb-4">
            <div class="card-body table-responsive">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <a href="{{ route('admin.kantin.create') }}" type="button" class="btn btn-primary mb-3"><i
                            class="fas fa-plus me-1"></i>Kantin</a>
                </div>

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
                        <th>Nama Kantin</th>
                        <th>Nama Admin</th>
                        <th>Email</th>
                        <th>Nomor Handphone</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($kantins ->count())
                        @foreach ($kantins as $kantin)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $kantin->nama_kantin }}</td>
                                <td class="text-center">{{ $kantin->nama_admin }}</td>
                                <td class="text-center">{{ $kantin->email }}</td>
                                <td class="text-center">{{ $kantin->no_telp }}</td>
                                <td class="text-center">
                                    <a href="{{route('admin.kantin.edit', $kantin->id_kantin)}}" class="badge bg-warning"><i
                                            class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{route('admin.kantin.delete', $kantin->id_kantin)}}" method="POST"
                                          class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0 btnDelete" data-object="kantins"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-danger text-center p-4">
                                <h4>Operator belum membuat pengguna</h4>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
