@extends('pavle.master')
@section('title', "Movie Name")

@section('main')
<div class="single-movie">
        <img class="box single-box" src="{{ $product->image }}">
    <div class="single-info">
        <span class="movieName fontNew">{{$product->title}} ({{$product->year}})
            <span class="box-rating">{{$product->rating}}</span>
{{--            stavio sam ovo ovde za testiranje, ti namesti gde hoces, to je poruka kad neko doda/obrise film na ovoj stranici--}}
            @if(session()->has('success'))
                            <div class="alert alert-success hide">
                    {{ session()->get('success') }}
                </div>
            @endif
{{--            -----}}
            @auth()

                @if(!auth()->user()->hasProduct($product))

                    <form method="GET" action="{{route('product.add', $product->slug)}}">
                        @csrf
                        <button class="wishlist-box-btn box-rating single-btn font-big" title="Add to wishlist">&#x2764;</button>
                    </form>

                @else

                    <form method="GET" action="{{route('product.remove', $product->slug)}}">
                        @csrf
                        <button class="fa fa-trash trash single-btn font-big"></button>
                    </form>

                @endif

            @endauth
            <button class="wishlist-box-btn box-rating single-btn font-big" title="Watch Trailer"onclick="document.getElementById('myModal').style.display='block'">&#x25b6; Play Trailer</button>
        </span>
        <span>Duration: {{$product->duration}}</span>
        <br>
        <span>PLOT:</span>
        <p class="fontNew">{{$product->plot}}
        </p>
        <span>ACTORS: </span>

        <span>
            @foreach($product->actors as $actor)

                <span class="commas fontNew"> <strong>{{$actor->name}}</strong> as {{$actor->pivot->character}}</span>

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

@section('script')
<script>
    function myFunction() {
        document.getElementById("myFrame").src = document.getElementById("myFrame").src;
        document.getElementById('myModal').style.display='none'
    }
</script>
@endsection
