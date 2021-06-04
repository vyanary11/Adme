@extends('layouts.landing.skeleton')

@section('app')
    @include('partials.landing.navbar')
    @yield('content')
    @include('partials.landing.footer')
@endsection

@push('javascript')
    <script>
        $(document).ready(function(){
            $(document).on("scroll", onScroll);
            $('a[href*="#"]:not([href="#"])').click(function () {
                if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                    $(document).off("scroll");
                    $('a[href*="#"]:not([href="#"])').each(function () {
                        $(this).removeClass('active');
                        $(this).addClass('active');
                    })
                    $(this).addClass('active');
                    $(this).removeClass('active');
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    if (target.length) {
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 500, 'swing', function () {
                            $(document).on("scroll", onScroll);
                        });
                        return false;
                    }
                }
            });

            function onScroll(event){
                var scrollPos = $(document).scrollTop();
                $('a[href*="#"]:not([href="#"])').each(function () {
                    var currLink = $(this);
                    var refElement = $(currLink.attr("href"));
                    if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                        currLink.closest( "li" ).removeClass('active');
                        currLink.closest( "li" ).addClass('active');
                    }
                    else{
                        currLink.closest( "li" ).addClass('active');
                        currLink.closest( "li" ).removeClass('active');
                    }
                });
            }
        });

    </script>
@endpush
