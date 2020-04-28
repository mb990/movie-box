@extends('pavle.master')
@section('title', "Movie Name")

@section('header')
<div class="header-top header-top-wishlist">
    <div class="webName">THE MOVIE BOX</div>
    <div class="logIn"><a href=""><button class="btn-login">LOG IN</button></a></div>
    <div class="signUp"><a href=""><button class="active-color">SIGN UP</button></a></div>
</div>
@endsection

@section('main')
<div class="single-movie">
    <div class="box single-box">
    </div>
    <div class="single-info">
        <span class="movieName">{{$product->title}} ({{$product->year}})
            <span class="box-rating">{{$product->rating}}</span>
            <button class="wishlist-box-btn box-rating single-btn" title="Add to wishlist">&#x2764;</button>
            <button class="wishlist-box-btn box-rating single-btn" title="Watch Trailer"onclick="document.getElementById('myModal').style.display='block'">&#x25b6; Play Trailer</button>
        </span>
        <span>Duration: {{$product->duration}}</span>
        <br>
        <span>PLOT:</span>
        <p>{{$product->plot}}
        </p>
        <span>
            Actors: {{$product->actors->implode('name', ', ')}}
        </span>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="trailer">
            <iframe width="640" height="480" src="https://www.youtube.com/embed/v_SyrpYk-Ik" frameborder="0" 
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>

                <span class="close" onclick="document.getElementById('myModal').style.display='none'">CLOSE &times;</span>
            </div>
        </div>
    </div>
</div>
@endsection
