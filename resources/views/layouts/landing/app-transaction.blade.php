@extends('layouts.landing.skeleton')
@push('css')
    <style>
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 60px; /* Set the fixed height of the footer here */
        line-height: 60px; /* Vertically center the text there */
        background-color: #f5f5f5;  
    }
    </style>
@endpush
@section('app')
    @include('partials.landing.navbar')
    @yield('content')
@endsection