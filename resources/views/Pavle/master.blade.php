<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title'){{$title}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="header-top">
            <a class="noUnderline" href="{{route('homepage.trending')}}"><div class="web-logo">THE MOVIE BOX</div></a>

        @guest()

            <div class="logIn"><a href="{{route('login')}}"><button class="btn-login">LOG IN</button></div></a>
            <div class="signUp"><a href="{{route('register')}}"><button class="active-color">SIGN UP</button></div></a>

        @endguest

        @auth()
            <div class="logIn"><a href=""><button class="active-color">YOUR WISHLIST</button></div></a>
            <div class="logIn"><a href="{{route('logout')}}"><button class="btn-login">LOGOUT</button></div></a>

        @endauth
    </div>
        @yield('header')
        <main>
            @yield('main')
        </main>
        <footer class="footer">
            <div class="footer-left">
                <span class="footer-webName">THE MOVIE BOX</span>
                <span>Designed by Quantox. All rights reserved.</span>
            </div>
            <div class="footer-right">
                <div>
                    <a class="footer-nav-links" href="">About</a>
                    <a class="footer-nav-links" href="">Movies</a>
                    <a class="footer-nav-links" href="">Rating</a>
                    <a class="footer-nav-links" href="">Contact</a>
                </div>
                <div class="social">
                    <a href="#" class="fa fa-facebook fa-social"></a>
                    <a href="#" class="fa fa-pinterest fa-social"></a>
                    <a href="#" class="fa fa-twitter fa-social"></a>
                    <a href="#" class="fa fa-linkedin fa-social"></a>
                </div>
            </div>
        </footer>
@yield('script')
    </body>
</html>
