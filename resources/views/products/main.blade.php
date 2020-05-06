@extends('layouts.master')

@section('title', '')

@section('main-top')
    <header class="header">
        <img class="header-image" src="{{ $recommended['data']->image }}">
        <div class="header-mid">
            <a href="{{route('product.single', $recommended['data']->slug)}}" class="no-underline" ><div class="movie-name pink">{{$recommended['data']->title}}</div></a>
            <div class="movie-info">
                <div class="movie-actors pink">{{$recommended['actors']->implode('name', ', ')}}</div>
                <div class="movie-duration pink">Duration: {{$recommended['data']->duration}}</div>
            </div>
            <div class="header-bot">
                <span class="inline">
                    <a href="https://google.com/search?q={{$recommended['data']->title}}watch online"><button class="active-color  button-recommended">WATCH MOVIE</button></a>
                    <a href="{{route('product.single', $recommended['data']->slug)}}"><button class="btn-info  button-recommended pink">VIEW INFO</button></a>

                    @auth()

                        @if(!auth()->user()->hasProduct($recommended['data']))

                            <form action="{{route('product.add', $recommended['data']->slug)}}" method="GET">

                                @csrf
                                <button class="btn-wishlist button-recommended pink">+ ADD TO WISHLIST</button>

                            </form>

                        @else

                            <form action="{{route('product.remove', $recommended['data']->slug)}}">

                                @csrf
                                <button class="btn-wishlist button-recommended pink">REMOVE FROM WISHLIST</button>

                            </form>

                        @endif

                    @endauth
                </span>


                <div class="header-rating help" title="Based on {{$recommended['data']->rating_votes}} reviews">
                Rating: {{$recommended['data']->rating}}
                </div>
            </div>
        </div>
    </header>
@endsection
@section('main')
@include('includes.navigation')
@if(session()->has('success'))
    <div class="alert alert-success hide">
        {{ session()->get('success') }}
    </div>
@endif

@if(!Request::is('search'))

    <div class="filters font-new" >
        <form method="GET" action="{{route('products.filtered')}}">
                @csrf

                <label for="per_page">Show</label>
                <select name="per_page" id="per_page">
                    <option value="4">4</option>
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="20">20</option>
                </select>

                <label for="min_rating">Min rating</label>
                <input class="search-input" type="number" name="min_rating" id="min_rating" min="1.0" max="9.9" step="0.1">

                <label for="max_rating">Max rating</label>
                <input class="search-input" type="number" name="max_rating" id="max_rating" min="1.1" max="10" step="0.1">

                <label for="min_year">Min year</label>
                <input class="search-input" type="number" name="min_year" id="min_year" min="1900" max="{{date("Y") - 1}}">

                <label for="max_year">Max year</label>
                <input class="search-input" type="number" name="max_year" id="max_year" min="1960" max="{{date("Y")}}">

                <select name="sorting" id="sort">
                    <option value="rating desc">Rating descending</option>
                    <option value="rating asc">Rating ascending</option>
                    <option value="year desc">Year descending</option>
                    <option value="year asc">Year ascending</option>
                </select>

                <button class="button-recommended active-color" type="submit">Filter</button>

            </form>
    </div>

@endif
<div class="all-movies js-moviesColumn">

    @if($errors->any())
    <h4 class="no-results">{{$errors->first()}}</h4>

    @endif


    @if(($data['products']->isNotEmpty()))

        @foreach($data['products'] as $product)
            <div class="box">
                <a href="{{route('product.single', $product->slug)}}">
                    <img src="{{ $product->image }}" class="box-picture">
                </a>
                <div class="box-info">
                    <div class="box-name">
                        <label for="boxPicture">{{substr($product->title, 0, 20)}}@if(strlen($product->title) > 20)... @endif <span>({{($product->year)}})</span></label>

                        <span class="actors font-new">

                            @if($data['actors'][$product->slug]->isNotEmpty())

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

        <p>No movies</p>

    @endif

</div>

@if(!empty($data['products']))

    <div class="center">
        {{$data['products']->appends($_GET)->links()}}
    </div>

@endif
@endsection

@section('script')
<script>
    var list = document.querySelector(".js-list");
    var grid = document.querySelector(".js-grid");
    var listGrid = document.querySelector(".js-moviesColumn");
    function listView() {
        list.classList.add("active-nav");
        grid.classList.remove("active-nav");
        listGrid.style.flexFlow = 'column';
        listGrid.style.alignItems = 'centre';
        listGrid.style.paddingLeft= "40vw";
    }
    function gridView() {
        list.classList.remove("active-nav");
        grid.classList.add("active-nav");
        listGrid.style.flexFlow = 'row wrap';
        listGrid.style.alignItems = 'none';
        listGrid.style.paddingLeft= "0px";
    }
</script>
@endsection
