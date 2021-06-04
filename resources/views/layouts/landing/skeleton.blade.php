<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        @include('partials.favicon')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/slicknav.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/progressbar_barfiller.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/gijgo/gijgo.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/animated-headline.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('modules/landing/nice-select.css') }}">
        <link rel="stylesheet" href="{{ mix('css/landing/app.css') }}">
        @stack('css')
        <title>Landing | Tailwind Starter Kit by Creative Tim</title>
    </head>
    <body>
            <!-- ? Preloader Start -->
            <div id="preloader-active">
                <div class="preloader d-flex align-items-center justify-content-center">
                    <div class="preloader-inner position-relative">
                        <div class="preloader-circle"></div>
                        <div class="preloader-img pere-text">
                            <img src="{{ asset('assets/mini-logo.png') }}" alt="" style="margin-top: -8px;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Preloader Start -->
            <div id="app">
                @yield('app')
            </div>
    </body>
    <script src="{{ mix('js/dashboard/manifest.js') }}"></script>
    <script src="{{ mix('js/dashboard/vendor.js') }}"></script>
    <script src="{{ mix('js/landing/app.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('modules/landing/jquery.slicknav.min.js') }}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('modules/landing/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('modules/landing/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('modules/landing/wow.min.js') }}"></script>
    <script src="{{ asset('modules/landing/animated.headline.js') }}"></script>
    <script src="{{ asset('modules/landing/jquery.magnific-popup.js') }}"></script>

    <!-- Date Picker -->
    <script src="{{ asset('modules/landing/gijgo/gijgo.min.js') }}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{ asset('modules/landing/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('modules/landing/jquery.sticky.js') }}"></script>
    <!-- Progress -->
    <script src="{{ asset('modules/landing/jquery.barfiller.js') }}"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="{{ asset('modules/landing/jquery.counterup.min.js') }}"></script>
    {{-- <script src="{{ asset('modules/landing/waypoints.min.js') }}"></script> --}}
    <script src="{{ asset('modules/landing/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('modules/landing/hover-direction-snake.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('modules/landing/contact.js') }}"></script>
    <script src="{{ asset('modules/landing/jquery.form.js') }}"></script>
    <script src="{{ asset('modules/landing/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('modules/landing/mail-script.js') }}"></script>
    <script src="{{ asset('modules/landing/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('modules/landing/plugins.js') }}"></script>
    <script src="{{ asset('modules/landing/main.js') }}"></script>
    @stack('javascript')
</html>
