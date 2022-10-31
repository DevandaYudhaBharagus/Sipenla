<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/internal-images/logo.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="/css/css-internal/main.css">

    {{-- include style css --}}
    @include('includes.style')

    <title>@yield('title')</title>
</head>

<body>
    <section class="landing-page">
        <div class="logo">
            <img src="{{ asset('images/internal-images/logo.svg') }}" alt="" />
        </div>
        <div class="container">
            @yield('content')
        </div>
    </section>
    {{-- main javascript --}}
    @include('includes.script')
    {{-- javascript internal --}}
    @stack('addon-javascript')
</body>

</html>
