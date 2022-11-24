<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/internal-images/logo.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="/css/css-internal/landing.css" />
    <link rel="stylesheet" href="/css/css-internal/slick.css" />
    <link rel="stylesheet" href="/css/css-internal/slick-theme.css" />

    @include('includes.style')
    <title>@yield('title')</title>
</head>

<body>
    @yield('content')

    @include('includes.script')

    <script src="/css/css-internal/slick.js"></script>
    <script src="/css/css-internal/slick.min.js"></script>
    @stack('addon-javascript')

</body>

</html>
