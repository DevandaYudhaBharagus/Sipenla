<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('includes.style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/css-internal/master.css" />
    <link rel="icon" href="{{ asset('images/internal-images/logo.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>@yield('title')</title>
    @yield('meta_header')
</head>

<body>
    @include('includes.sidebar')
    <section class="home-section">
        @include('includes.navbar-master')

        <div class="content-home">
            @yield('content')
        </div>
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
    </section>

    @yield('modal')
    <script>
        window.onload = function() {
            const sidebar = document.querySelector(".sidebar");
            const closeBtn = document.querySelector("#btn-icon");

            closeBtn.addEventListener("click", () => {
                sidebar.classList.toggle("open");
                btnIconChange();
            });

            function btnIconChange() {
                if (sidebar.classList.contains("open")) {
                    closeBtn.classList.replace(
                        "fa-angle-double-right",
                        "fa-angle-double-left"
                    );
                } else {
                    closeBtn.classList.replace(
                        "fa-angle-double-left",
                        "fa-angle-double-right"
                    );
                }
            }
        };
    </script>
    <script>
        const btnDropdown = document.querySelectorAll("#dropdown-keuangan");
        const menu = document.querySelectorAll(".menu-dropdown");
        const sidebar = document.querySelector(".sidebar")


        for (let i = 0; i < btnDropdown.length; i++) {
            btnDropdown[i].addEventListener("click", () => {
                if (sidebar.classList.contains('open')) {
                    menu[i].classList.toggle("show");
                }
            });
        }
    </script>

    @include('includes.script')
    @stack('addon-javascript')

</body>

</html>
