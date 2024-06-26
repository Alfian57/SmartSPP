@section('title')
    Login
@endsection

<x-auth-layouts::main>
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
            <div class="sign-btn text-center">
                <button type="submit" class="btn btn-theme">Login</button>
            </div>
        </form>
    </div>
</x-auth-layouts::main>
