<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('includes.style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/css-internal/dashboard.css" />
    <link rel="icon" href="{{ asset('images/internal-images/logo.png') }}" type="image/x-icon" />
    <title>@yield('title')</title>
</head>

<body>
    @include('includes.navbar')

    @yield('content')


    @include('includes.script')
    @stack('addon-javascript')

</body>

</html>
