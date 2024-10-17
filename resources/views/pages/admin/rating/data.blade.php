@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-sm-6 col-md-8">
                <h1 class="mt-4">Daftar Konsumen</h1>
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
{{--                    <a href="{{ route('admin.konsumen.create') }}" type="button" class="btn btn-primary mb-3"><i--}}
{{--                            class="fas fa-plus me-1"></i>Konsumen</a>--}}
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
                            <th>Name Konsumen</th>
                            <th>Nama Kantin</th>
                            <th>Nama Menu</th>
                            <th>Rating</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($data ->count())
                            @foreach ($data as $rating)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $rating->nama_konsumen }}</td>
                                    <td class="text-center">{{ $rating->nama_kantin}}</td>
                                    <td class="text-center">{{ $rating->nama_menu }}</td>
                                    <td class="text-center">{{ $rating->rating }}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.rating.show', $rating->id)}}" class="badge bg-warning"><i
                                                class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{route('admin.rating.delete', $rating->id)}}" method="POST"
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
