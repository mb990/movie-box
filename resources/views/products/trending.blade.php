<!DOCTYPE html>
<html>
    <head>
        <title>Movie-box</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    </head>
    <body>
        <header class="header">
            <div class="header-top">
                <div class="webName">THE MOVIE BOX</div>
                <div class="logIn"><button class="btn-login">LOG IN</button></div>
                <div class="signUp"><button class="active-color">SIGN UP</button></div>
            </div>
            <div class="header-mid">
                <div class="movieName">MOVIE NAME</div>
                <div class="movie-info">
                    <div class="movieGenre">Genre</div>
                    <div class="movieDuration">Duration</div>
                </div>
                <div class="header-bot">
                    <button class="active-color">WATCH MOVIE</button><button class="btn-info">VIEW INFO</button><button class="btn-wishlist">+ ADD TO WISHLIST</button>
                </div>
            </div>
        </header>
        <main>
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
            <div class="movieNav">
                <span class="nav-tab active-nav">Trending</span>
                <span class="nav-tab">Top Rated</span>
                <span class="nav-tab">New Arrivals</span><!-- SEARCH BUTTON -->
                <form action="{{route('search')}}" class="nav-tab-search">
                    <input type="text" class="search-input" placeholder="Search movie.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                <!-- END SEARCH BUTTON -->
                <div class="nav-grid">
                    <button class="btn-nav active-nav">
                        <svg class="bi bi-grid active-nav grid-view" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 012.5 1h3A1.5 1.5 0 017 2.5v3A1.5 1.5 0 015.5 7h-3A1.5 1.5 0 011 5.5v-3zM2.5 2a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 1h3A1.5 1.5 0 0115 2.5v3A1.5 1.5 0 0113.5 7h-3A1.5 1.5 0 019 5.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zM1 10.5A1.5 1.5 0 012.5 9h3A1.5 1.5 0 017 10.5v3A1.5 1.5 0 015.5 15h-3A1.5 1.5 0 011 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 9h3a1.5 1.5 0 011.5 1.5v3a1.5 1.5 0 01-1.5 1.5h-3A1.5 1.5 0 019 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <button class="btn-nav list-view">
                        <i class="material-icons">&#xe164;</i>
                    </button>
                </div>
            </div>
            <div class="allMovies">

                @foreach($products as $product)

                    <div class="box">
                        <div class="boxPicture">
                        </div>
                        <div class="boxInfo">
                            <label for="boxPictures">{{$product->title}}</label>
                            <span>{{$product->rating}}</span>
                        </div>
                    </div>

                @endforeach

            </div>

            {{$products->links()}} dodaj centriranje
        </main>
        <footer>
            <div class="footer-left">
                <span class="footer-webName">THE MOVIE BOX</span>
                <span class="designed">Designed by Quantox. All rights reserved.</span>
            </div>
            <div class="links footer-right">
                <div class="footer-nav">
                    <a class="footer-nav-links" href="">About</a>
                    <a class="footer-nav-links" href="">Movies</a>
                    <a class="footer-nav-links" href="">Rating</a>
                    <a class="footer-nav-links" href="">Contact</a>
                </div>
                <div class="social">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-pinterest"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-linkedin"></a>
                </div>
            </div>
        </footer>
        <script src="/public/js/main.js"></script>
    </body>
</html>
