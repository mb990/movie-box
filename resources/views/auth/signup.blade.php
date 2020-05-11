<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="{{ asset('css/login-sign.css') }}" >
<title>Sign Up</title>
</head>
<body>
    <div class="login-page">
    <span class="welcome">Welcome to MovieBox</span>
        <div class="form">
        <form action="{{route('register')}}" method="POST" class="login-form">
            @csrf
            <input name="name" type="text" placeholder="name" class="@error('name') is-invalid @enderror" required autocomplete="name" autofocus/>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input name="email" type="text" placeholder="email address" class="@error('emaeil') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email"/>

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input name="password" type="password" placeholder="password" class="@error('password') is-invalid @enderror" required autocomplete="new-password"/>

            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <input name="password_confirmation" type="password" placeholder="confirm password" required autocomplete="new-password"/>
            <button>create</button>
            <p class="message">Already registered? <a href="/login">Sign In</a></p>
            <p class="message"><a href="/">Go back</a></p>
        </form>
        </div>
    </div>
</body>
