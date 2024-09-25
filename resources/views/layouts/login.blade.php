<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Kantin | @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo-color.png') }}" />
    {{-- style --}}
    @include('includes.login.style')
</head>

<body class="my-login-page">

{{-- main --}}
@yield('content')

{{-- script --}}
@include('includes.login.script')
</body>

</html>
