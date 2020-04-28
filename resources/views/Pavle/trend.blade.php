@extends('pavle.master')
@section('title', 'Trending')
@section('header')
<header class="header">
    <div class="header-top">
        <div class="webName">THE MOVIE BOX</div>
        <div class="logIn"><button class="btn-login">LOG IN</button></div>
        <div class="signUp"><button class="active-color">SIGN UP</button></div>
    </div>
    <div class="header-mid">
        <div class="movieName">{{$recommended['data']->title}}</div>
        <div class="movie-info">
            <div class="movieGenre">{{$recommended['actors']->implode('name', ', ')}}</div>
            <div class="movieDuration">Duration: {{$recommended['data']->duration}}</div>
        </div>
        <div class="header-bot">
            <button class="active-color">WATCH MOVIE</button>
            <button class="btn-info">VIEW INFO</button>
            <button class="btn-wishlist">+ ADD TO WISHLIST</button>
            <div class="header-rating">Rating: 4.5</div>
        </div>
    </div>
</header>
@endsection
@section('main')
<div class="movieNav">
                <a href="/" class="nav-tab active-nav">Trending</a>
                <a href="/top" class="nav-tab">Top Rated</a>
                <a href="new" class="nav-tab">New Arrivals</a>
                <!-- SEARCH BUTTON -->
                <form action="{{route('search')}}" class="nav-tab-search">
                    <input type="text" class="search-input" placeholder="Search movie.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
                <!-- END SEARCH BUTTON -->
                <div class="nav-grid">
                    <button class="btn-nav active-nav">
                        <svg class="bi bi-grid active-nav" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 012.5 1h3A1.5 1.5 0 017 2.5v3A1.5 1.5 0 015.5 7h-3A1.5 1.5 0 011 5.5v-3zM2.5 2a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 1h3A1.5 1.5 0 0115 2.5v3A1.5 1.5 0 0113.5 7h-3A1.5 1.5 0 019 5.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zM1 10.5A1.5 1.5 0 012.5 9h3A1.5 1.5 0 017 10.5v3A1.5 1.5 0 015.5 15h-3A1.5 1.5 0 011 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 9h3a1.5 1.5 0 011.5 1.5v3a1.5 1.5 0 01-1.5 1.5h-3A1.5 1.5 0 019 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <button class="btn-nav">
                        <i class="material-icons">&#xe164;</i>
                    </button>
                </div>
            </div>
            <div class="allMovies">
                @foreach($data['products'] as $product)
                    <div class="box">
                        <a href="/movies/{{$product->slug}}">
                            <img  src="{{ $product->image }}" class="boxPicture">
                        </a>
                        <div class="boxInfo">
                            <div class="box-name">
                                <label for="boxPictures">{{substr($product->title, 0, 20)}}@if(strlen($product->title) > 20)...@endif</label>
                                <span class="actors">
                                    {{$data['actors'][$product->slug]->implode('name', ', ')}}
                                </span>
                            </div>

                            @auth()

                                @if(auth()->user()->hasProduct($product->slug))

                                    <a href="/movies/{{$product->slug}}/add"><button class="wishlist-box-btn box-rating" title="Add to wishlist">&#x2764;</button></a>


                                @else

                                    <a href="/movies/{{$product->slug}}/remove"><button class="wishlist-box-btn box-rating" title="Remove from wishlist">&#x2764;</button></a>

                                @endif

                            @endauth

                            <div class="box-rating" title="Movie Rating">{{$product->rating}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="center">
            {{$data['products']->links()}}
            </div>
@endsection
