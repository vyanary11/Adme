<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    @include('partials.favicon')
    <title>Login &mdash; {{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/dashboard/app.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-2">
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </section>
    </div>
    {{-- <script src="{{ mix('js/dashboard/manifest.js') }}"></script>
    <script src="{{ mix('js/dashboard/vendor.js') }}"></script> --}}
    <script src="{{ mix('js/dashboard/app.js') }}"></script>
</body>
</html>
