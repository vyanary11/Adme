@extends('layouts.dashboard.skeleton')

@section('app')
    <div class="main-wrapper container">
        <div class="navbar-bg2"></div>
        <nav class="navbar navbar-expand-lg main-navbar container">
            <a href="dashboard-general.html" class="navbar-brand">Stisla</a>
            <ul class="navbar-nav navbar-right ml-auto">
                @auth('member')
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="../dist/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Logged in 5 min ago</div>
                        <a href="features-profile.html" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                        <a href="features-activities.html" class="dropdown-item has-icon">
                            <i class="fas fa-bolt"></i> Activities
                        </a>
                        <a href="features-settings.html" class="dropdown-item has-icon">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        </div>
                    </li>
                @else
                    <a href="" class="btn bg-white">Login</a>
                @endauth

            </ul>
        </nav>
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-body">
                    @yield('content')
                </div>
            </section>
        </div>
        <footer class="main-footer">
            @include('partials.dashboard.footer')
        </footer>
    </div>
@endsection


