<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/css/css-internal/dashboard.css" />
    <link rel="icon" href="{{ asset('images/internal-images/logo.png') }}" type="image/x-icon" />
    @include('includes.style')
    <title>@yield('title')</title>
</head>

<body>
    @include('includes.navbar')

    @yield('content')

    @include('includes.script')
    {{-- javascript internal --}}
    @stack('addon-javascript')
</body>

</html>
