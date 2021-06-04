@extends('layouts.auth')

@section('content')
<div class="col-12 col-sm-10 offset-sm-1 col-lg-8 offset-lg-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
    <div class="login-brand">
        <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
    </div>
    @if(session()->has('info'))
        <div class="alert alert-primary">
            {{ session()->get('info') }}
        </div>
    @endif
    @if(session()->has('status'))
        <div class="alert alert-info">
            {{ session()->get('status') }}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header"><h4>Register</h4></div>

        <div class="card-body">
            <form method="POST" action="{{route('register')}}" class="needs-validation" novalidate="">
                @csrf
                <div class="row">
                    <div class="form-group col-12 col-lg-6">
                        <label for="first_name">Nama Depan</label>
                        <input id="first_name" type="text" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" name="first_name" autofocus required>
                        <span class="invalid-feedback" role="alert">
                            <strong> @error('first_name') {{ $message }} @else Wajib diisi !! @enderror</strong>
                        </span>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="last_name">Nama Belakang</label>
                        <input id="last_name" type="text" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" name="last_name" autofocus required>
                        <span class="invalid-feedback" role="alert">
                            <strong> @error('last_name') {{ $message }} @else Wajib diisi !! @enderror</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong>@error('email') {{ $message }} @else Email wajib disi !! @enderror</strong>
                    </span>
                </div>

                <div class="form-group">
                    <label for="phone">No. Telepon</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong>@error('phone') {{ $message }} @else Wajib disi !! @enderror</strong>
                    </span>
                </div>

                <div class="row">
                    <div class="form-group col-lg-6 col-12">
                        <label for="password" class="d-block">Password</label>
                        <input id="password" type="password" data-indicator="pwindicator" class="form-control pwstrength @error('email') is-invalid @enderror" name="password" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong>@error('password') {{ $message }} @else wajib disi !! @enderror</strong>
                        </span>
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6 col-12">
                        <label for="password2" class="d-block">Konfirmasi Password</label>
                        <input id="password2" type="password" class="form-control @error('password_confirm') is-invalid @enderror" name="password_confirm" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong>@error('password_confirm') {{ $message }} @else wajib disi !! @enderror</strong>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input @error('agree') is-invalid @enderror" name="agree" autofocus required id="agree">
                        <label class="custom-control-label" for="agree">Saya setuju dengan <a href="">Kebijikan & Privasi</a></label>
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Daftar
                    </button>
                </div>
            </form>
            Sudah punya akun ? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
    <div class="simple-footer">
        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
    </div>
</div>
@endsection
