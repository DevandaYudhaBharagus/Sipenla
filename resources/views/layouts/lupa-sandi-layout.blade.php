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
    <section class="forgot-password">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/internal-images/logo.svg') }}" alt="Logo" width="45"
                        height="45" class="d-inline-block align-text-center me-2" />
                    SIPENLA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="material-icons">view_headline</i></span>
                </button>
            </div>
        </nav>

        @yield('content')
    </section>
    @include('includes.script')
    @stack('addon-javascript')
</body>

</html>
