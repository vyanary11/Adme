<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'Home') &mdash; {{ config('app.name') }}</title>
    @include('partials.favicon')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('stylesheet')
    <link rel="stylesheet" href="{{ mix('css/dashboard/app.css') }}">
</head>

<body @if(request()->is('member/transaction') || request()->is('member/transaction/**')) class="layout-4" @else  @endif>
    <div id="app">
        @yield('app')
    </div>
    <script>
        var dataFilter={};
    </script>
    <script src="{{ mix('js/dashboard/manifest.js') }}"></script>
    <script src="{{ mix('js/dashboard/vendor.js') }}"></script>
    <script src="{{ mix('js/dashboard/app.js') }}"></script>

    @stack('modal')

    @stack('javascript')

    @if(Request::segment(2)==null)
        @if (file_exists(public_path().'/js/dashboard/'.Request::segment(1).'/'.Request::segment(1).'.js'))
            <script src="{{ mix('js/dashboard/'.Request::segment(1).'/'.Request::segment(1).'.js') }}"></script>
        @endif
    @else
        @if(Request::segment(3)==null)
            @if (file_exists(public_path().'/js/dashboard/'.Request::segment(1).'/'.str_replace('-','_', Request::segment(2)).'/'.str_replace('-','_', Request::segment(2)).'.js'))
                <script src="{{ mix('js/dashboard/'.Request::segment(1).'/'.str_replace('-','_', Request::segment(2)).'/'.str_replace('-','_', Request::segment(2)).'.js') }}"></script>
            @endif
        @else
            @if (file_exists(public_path().'/js/dashboard/'.Request::segment(1).'/'.str_replace('-','_', Request::segment(2)).'/'.str_replace('-','_', Request::segment(3)).'.js'))
                <script src="{{ mix('js/dashboard/'.Request::segment(1).'/'.str_replace('-','_', Request::segment(2)).'/'.str_replace('-','_', Request::segment(3)).'.js') }}"></script>
            @endif
        @endif
    @endif
    @if(session('message'))
        <script>
            Swal.fire(
                "{{ session('message')['status'] }}",
                "{{ session('message')['message'] }}",
                "{{ session('message')['status'] }}",
            );
        </script>
    @endif
</body>
</html>
