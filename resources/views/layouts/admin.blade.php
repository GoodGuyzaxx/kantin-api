<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="SPK Pemilihan Siswa Berprestasi" />
    <meta name="author" content="Malas Coding" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo-color.png') }}" />
    <title>Kantin | Dashboard</title>

    {{-- style --}}
    @include('includes.admin.style')

</head>

<body class="sb-nav-fixed">

    {{-- navbar --}}
    @include('includes.admin.navbar')


    <div id="layoutSidenav">

        {{-- sidenav --}}
        @include('includes.admin.sidenav')

        {{-- content --}}
        <div id="layoutSidenav_content">
            {{-- content --}}
            @yield('content')

            {{-- footer --}}
            @include('includes.admin.footer')
        </div>
    </div>

    @include('includes.admin.script')

</body>

</html>
