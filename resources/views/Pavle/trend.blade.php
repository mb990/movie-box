@extends('pavle.master')
@section('title')

    @if(Request::is('/'))

        Trending

    @elseif (Request::is('top'))

        Top Rated

    @else

        New Arrivals

    @endif

@endsection
@section('header')
    <header class="header">
        <img class="header" src="https://www.filmofilia.com/wp-content/uploads/2012/02/wrath_of_the_titans.jpg">
        <div class="header-mid">
            <a href="{{route('product.single', $recommended['data']->slug)}}" class="noUnderline" ><div class="movieName">{{$recommended['data']->title}}</div></a>
            <div class="movie-info">
                <div class="movieGenre">{{$recommended['actors']->implode('name', ', ')}}</div>
                <div class="movieDuration">Duration: {{$recommended['data']->duration}}</div>
            </div>
            <div class="header-bot">
                <button class="active-color">WATCH MOVIE</button>
                <a href="{{route('product.single', $recommended['data']->slug)}}"><button class="btn-info">VIEW INFO</button></a>
                <button class="btn-wishlist">+ ADD TO WISHLIST</button>
                <div class="header-rating help" title="Based on {{$recommended['data']->rating_votes}} reviews">
                Rating: {{$recommended['data']->rating}}
                </div>
            </div>
        </div>
    </header>
@endsection
@section('main')
<div class="movieNav">
    <a title="Trending" href="{{route('homepage.trending')}}" class="nav-tab {{ Request::is('/') ? 'active-nav' : ''}}">Trending</a>
    <a title="Top Rated" href="{{route('homepage.top')}}" class="nav-tab {{ Request::is('top') ? 'active-nav' : ''}}">Top Rated</a>
    <a title="New Arrivals" href="{{route('homepage.new')}}" class="nav-tab {{ Request::is('new') ? 'active-nav' : ''}}">New Arrivals</a>
    <!-- SEARCH BUTTON -->
    <form action="{{route('search')}}" class="nav-tab-search">
        @csrf
        <input type="text" class="search-input" placeholder="Search movie.." name="search">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    <!-- END SEARCH BUTTON -->
    <div class="nav-grid">
        <button class="btn-nav active-nav js-grid" onclick="gridView()">
            <svg class="bi bi-grid" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 2.5A1.5 1.5 0 012.5 1h3A1.5 1.5 0 017 2.5v3A1.5 1.5 0 015.5 7h-3A1.5 1.5 0 011 5.5v-3zM2.5 2a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 1h3A1.5 1.5 0 0115 2.5v3A1.5 1.5 0 0113.5 7h-3A1.5 1.5 0 019 5.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zM1 10.5A1.5 1.5 0 012.5 9h3A1.5 1.5 0 017 10.5v3A1.5 1.5 0 015.5 15h-3A1.5 1.5 0 011 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3zm6.5.5A1.5 1.5 0 0110.5 9h3a1.5 1.5 0 011.5 1.5v3a1.5 1.5 0 01-1.5 1.5h-3A1.5 1.5 0 019 13.5v-3zm1.5-.5a.5.5 0 00-.5.5v3a.5.5 0 00.5.5h3a.5.5 0 00.5-.5v-3a.5.5 0 00-.5-.5h-3z" clip-rule="evenodd"/>
            </svg>
        </button>
        <button class="btn-nav js-list" onclick="listView()">
            <i class="material-icons">&#xe164;</i>
        </button>
    </div>
</div>     
@if(session()->has('success'))
    <div class="alert alert-success hide">
        {{ session()->get('success') }}
    </div>
@endif      
<div class="allMovies moviesColumn">
    @if($errors->any())
    <h4 class="noResults">{{$errors->first()}}</h4>

    @endif

        <form method="GET" action="{{route('products.filtered')}}">
            @csrf
            <label for="min_rating">Min rating</label>
            <input type="number" name="min_rating" id="min_rating" min="1.0" max="9.9" step="0.1">

            <label for="max_rating">Max rating</label>
            <input type="number" name="max_rating" id="max_rating" min="1.1" max="10" step="0.1">

            <label for="sort_rating_asc">asc</label>
            <input type="radio" name="sort_rating" id="sort_rating_asc" value="asc">

            <label for="sort_rating_desc">desc</label>
            <input type="radio" name="sort_rating" checked="checked" id="sort_rating_desc" value="desc">

            <label for="min_year">Min year</label>
            <input type="number" name="min_year" id="min_year" min="1900" max="{{date("Y") - 1}}">

            <label for="max_year">Max year</label>
            <input type="number" name="max_year" id="max_year" min="1960" max="{{date("Y")}}">

            <label for="sort_year_asc">asc</label>
            <input type="radio" name="sort_year" id="sort_year_asc" value="asc">

            <label for="sort_year_desc">desc</label>
            <input type="radio" name="sort_year" checked="checked" id="sort_year_desc" value="desc">

            <button class="btn btn-success" type="submit">Filter</button>

        </form>

    @if(!empty($data['products']))

        @foreach($data['products'] as $product)
            <div class="box">
                <a href="{{route('product.single', $product->slug)}}">
                    <img src="{{ $product->image }}" class="boxPicture">
                </a>
                <div class="boxInfo">
                    <div class="box-name">
                        <label for="boxPictures">{{substr($product->title, 0, 20)}}@if(strlen($product->title) > 20)...@endif</label>
                        <span class="actors fontNew">

                            @if(!empty($data['actors'][$product->slug]))

                                {{$data['actors'][$product->slug]->implode('name', ', ')}}

                            @endif
                        </span>
                    </div>

                    @auth()

                    @if(!auth()->user()->hasProduct($product))

                        <form method="GET" action="{{route('product.add', $product->slug)}}">
                            @csrf
                            <button type="submit" class="wishlist-box-btn box-rating" title="Add to wishlist">&#x2764;</button>
                        </form>
                    @else

                        <form method="GET" action="{{route('product.remove', $product->slug)}}">
                            @csrf
                            <button type="submit" title="Remove from wishlist" class="fa fa-trash trash"></button>

                        </form>

                    @endif

                @endauth

                    <div class="box-rating help" title="based on {{$product->rating_votes}} reviews">{{$product->rating}}</div>
                </div>
            </div>
        @endforeach

        @else

        <p>no movies</p>

    @endif
</div>
<div class="center">
    {{$data['products']->links()}}
</div>
@endsection

@section('script')
<script>
    var list = document.querySelector(".js-list")
    var grid = document.querySelector(".js-grid")
    var listGrid = document.querySelector(".moviesColumn")
    function listView() {
        list.classList.add("active-nav");
        grid.classList.remove("active-nav");
        listGrid.style.flexFlow = 'column';
        listGrid.style.alignItems = 'center';
    }
    function gridView() {
        list.classList.remove("active-nav");
        grid.classList.add("active-nav");
        listGrid.style.flexFlow = 'row wrap';
        listGrid.style.alignItems = 'none';
    }
</script>
@endsection