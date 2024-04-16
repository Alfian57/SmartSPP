@extends('auth.layouts.main')

@section('content')
    <div class="authentication-form mx-auto">
        <div class="logo-centered">
            <img src="/logo.png" alt="Logo" class="img-fluid">
        </div>
        <h3>Login ke {{ config('app.name') }}</h3>
        <p>Senang melihatmu kembali!</p>
        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf

            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email" name="email" required
                    value="{{ old('email') }}">
                <i class="ik ik-user"></i>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <i class="ik ik-lock"></i>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                <div class="col text-left">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox"
                            value="option1">
                        <span class="custom-control-label">&nbsp;Ingat Saya</span>
                    </label>
                </div>
                <div class="col text-right">
                    <a href="forgot-password.html">Lupa Password ?</a>
                </div>
            </div>
            <div class="sign-btn text-center">
                <button type="submit" class="btn btn-theme">Login</button>
            </div>
        </form>
    </div>
@endsection
