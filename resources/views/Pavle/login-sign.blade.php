<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="{{ asset('css/login-sign.css') }}" >
</head>
<body>
    <section class="forms-section">
        <h1 class="section-title">Welcome to MovieBox</h1>
        <div class="forms">
        <div class="form-wrapper is-active">
            <button type="button" class="switcher switcher-login">
            Login
            <span class="underline"></span>
            </button>
            <form action="{{route('login')}}" method="POST" class="form form-login">
                @csrf
            <fieldset>
                <legend>Please, enter your email and password for login.</legend>
                <div class="input-block">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" required>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="input-block">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </fieldset>
            <button type="submit" class="btn-login">Login</button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
        <div class="form-wrapper">
            <button type="button" class="switcher switcher-signup">
            Sign Up
            <span class="underline"></span>
            </button>
            <form action="{{route('register')}}" method="POST" class="form form-signup">
                @csrf
            <fieldset>
                <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                <div class="input-block">
                    <label for="name">Username</label>
                    <input id="name" class="@error('name') is-invalid @enderror" name="name" type="text" required>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="input-block">
                    <label for="register-email">E-mail</label>
                    <input id="register-email" name="register-email" type="email" required>

                    <div class="col-md-6">


                    @error('register-email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                </div>
                <div class="input-block">
                    <label for="register-password">Password</label>
                    <input id="register-password" name="register-password" type="password" required>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="input-block">
                    <label for="password-confirm">Confirm password</label>
                    <input id="password-confirm" name="password-confirm" type="password" required>
                </div>
            </fieldset>
            <button type="submit" class="btn-signup">Continue</button>
            </form>
            <button class="btn-login">Go Back</button>
        </div>
        </div>
    </section>
    <script>
        const switchers = [...document.querySelectorAll('.switcher')]
        switchers.forEach(item => {
        item.addEventListener('click', function() {
        switchers.forEach(item => item.parentElement.classList.remove('is-active'))
        this.parentElement.classList.add('is-active')
    })
})
    </script>
</body>
