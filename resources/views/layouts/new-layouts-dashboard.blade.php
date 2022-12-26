<!DOCTYPE html>
<html lang="en">
<?php
    $email = Auth::user()->email;
    $hashGenerated = hash_hmac('sha256', $email, env('ONESIGNAL_REST_API_KEY'));
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('includes.style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/css-internal/dashboard.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="icon" href="{{ asset('images/internal-images/logo.png') }}" type="image/x-icon" />
    @yield('css')
    <title>@yield('title')</title>
    @yield('meta_header')

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
        <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
            appId: '{{ env('ONESIGNAL_APP_ID') }}',
            });
            let externalUserId = {!! json_encode($email) !!};
            OneSignal.setExternalUserId(externalUserId,{!! json_encode($hashGenerated) !!});
        });
        </script>
</head>

<body>
    @include('includes.navbar')

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 text-footer">
                    &copy
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    SIPENLA. All Rights Reserved
                </div>
            </div>
        </div>
    </footer>
    @yield('modal-dashboard')
    @include('includes.script')
    @stack('addon-javascript')
</body>

</html>
