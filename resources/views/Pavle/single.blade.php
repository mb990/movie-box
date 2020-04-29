@extends('pavle.master')
@section('title', "Movie Name")

@section('main')
<div class="single-movie">
    <div class="box single-box">
    </div>
    <div class="single-info">
        <span class="movieName fontNew">{{$product->title}} ({{$product->year}})
            <span class="box-rating">{{$product->rating}}</span>
            <button class="wishlist-box-btn box-rating single-btn" title="Add to wishlist">&#x2764;</button>
            <button class="fa fa-trash trash single-btn"></button>
            <button class="wishlist-box-btn box-rating single-btn" title="Watch Trailer"onclick="document.getElementById('myModal').style.display='block'">&#x25b6; Play Trailer</button>
        </span>
        <span>Duration: {{$product->duration}}</span>
        <br>
        <span>PLOT:</span>
        <p class="fontNew">{{$product->plot}}
        </p>
        <span>ACTORS: </span>

        <span>
            @foreach($product->actors as $actor)

                <span class="commas fontNew">{{$actor->name}} as {{$actor->pivot->character}}</span>

            @endforeach
        </span>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="trailer">
            <iframe id="myFrame" class="video" width="640" height="480" src="{{$product->embed_trailer}}" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
                <span class="close" 
                onclick="myFunction()"
                >CLOSE &times;</span>
            </div>
        </div>
    </div>
</div>
@endsection
