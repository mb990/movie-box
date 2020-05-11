<div class="header-top">
            <a class="no-underline web-logo" href="{{route('homepage.trending')}}"><div>THE MOVIE BOX</div></a>

        @guest()

            <div class="logIn"><a href="{{route('login')}}"><button class="btn-login button-recommended">LOG IN</button></div></a>
            <div class="signUp"><a href="{{route('register')}}"><button class="active-color button-recommended">SIGN UP</button></div></a>

        @endguest

        @auth()

            @if(!Request::is('wishlist'))

                <div class="logIn"><a href="{{route('wishlist')}}"><button class=" btn-login button-recommended">YOUR WISHLIST</button></div></a>

            @endif
            <div class="signUp"><a href="{{route('logout')}}"><button class="active-color button-recommended">LOGOUT</button></div></a>

        @endauth
</div>