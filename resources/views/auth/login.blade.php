@extends('layouts.auth')

@section('content')
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
    <div class="login-brand">
        <img src="{{ asset('assets/mini-logo.png') }}" alt="logo" width="66">
    </div>
    @if(Session::has('msg'))
        <div class="alert alert-{{ Session::get('msg')['type'] }} alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                {{ Session::get('msg')['message'] }}
            </div>
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header"><h4>Masuk</h4></div>

        <div class="card-body">
            <form method="POST" @if(Request::segment(1)=="admin") action="{{ route('admin.login') }}" @else action="{{ route('login') }}" @endif class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong>@error('email') {{ $message }} @else Email wajib disi !! @enderror</strong>
                    </span>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                            <a href="auth-forgot-password.html" class="text-small">Lupa Password?</a>
                        </div>
                    </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <span class="invalid-feedback" role="alert">
                        <strong> @error('password') {{ $message }} @else Password wajib diisi !! @enderror</strong>
                    </span>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" @if(old('remember')=="on") checked @endif class="custom-control-input" tabindex="3" id="remember-me">
                        <label class="custom-control-label" for="remember-me">Ingat Saya</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Masuk</button>
                </div>
            </form>
            @if(Request::segment(1)=="member")
                Belum punya akun ? <a href="{{ route('register') }}">Daftar</a>
            @endif
        </div>
    </div>
    <div class="simple-footer mt-4">
        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
    </div>
</div>
@endsection
