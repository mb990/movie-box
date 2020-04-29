<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="{{ asset('css/login-sign.css') }}" >
<title>Login</title>
</head>
<body>
    <div class="login-page">
        <span class="welcome">Welcome to MovieBox</span>
        <div class="form">
        <form action="{{route('login')}}" method="POST" class="login-form">
            @csrf

            <input class="@error('email') is-invalid @enderror" value="{{ old('email') }}" type="text" name="email" id="email" placeholder="email" required autocomplete="email" autofocus/>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            <input class="@error('password') is-invalid @enderror" type="password" id="password" name="password" placeholder="password" required autocomplete="current-password"/>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


            <button type="submit">login</button>
            <p class="message">Not registered? <a href="/register">Create an account</a></p>

            @if (Route::has('password.request'))
                <p class="message"><a href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }} </a>
                </p>
            @endif

            <p class="message"><a href="/">Go back</a></p>

        </form>
        </div>
    </div>
</body>
