<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kantin | Welcome</title>
    <link rel="icon" type="image/x-icon" href="{{asset('logo-color.png')}}" />
    {{-- style --}}
    @include('includes.landing.style')
</head>

<body id="page-top">


{{-- main --}}
@yield('content')

{{-- script --}}
@include('includes.landing.script')
</body>

</html>
