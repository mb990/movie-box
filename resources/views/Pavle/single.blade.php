@extends('pavle.master')
@section('title', "Movie Name")

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

            @foreach($product->actors as $actor)

                <p>{{$actor->name}} as {{$actor->pivot->character}}</p>

            @endforeach
{{--            Actors: {{$product->actors->implode('name', ', ')}}--}}
        </span>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="trailer">
{{--            <iframe width="640" height="480" src="{{$product->trailer}}" frameborder="0"--}}
{{--                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>--}}
{{--            </iframe>--}}

{{--                <video controls width="640" height="480">--}}
{{--                    <source src="{{$product->trailer}}"--}}
{{--                            type="video/webm">--}}
{{--                    <source src="{{$product->trailer}}"--}}
{{--                            type="video/mp4">--}}
{{--                </video>--}}

                <span class="close" onclick="document.getElementById('myModal').style.display='none'">CLOSE &times;</span>
            </div>
        </div>
    </div>
</div>
@endsection
