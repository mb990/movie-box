@extends('layouts.master')
@section('title', "")

@section('main')

    @if($errors->any())
        <h4 class="no-results">{{$errors->first()}}</h4>

    @endif

@if(session()->has('success'))
<div class="alert alert-success hide">
    {{ session()->get('success') }}
</div>
@endif
<div class="single-movie">
        <img class="box single-box" src="{{ $product->image }}">
    <div class="single-info">
        <span class="movie-name font-new inline-single">{{$product->title}} ({{$product->year}})
            <span class=" box-rating-single help" title="based on {{$product->rating_votes}} reviews">{{$product->rating}}</span>
            <span>
            @auth()
                @if(!auth()->user()->hasProduct($product))

                    <form method="GET" action="{{route('product.add', $product->slug)}}">
                        @csrf
                        <button class="single-btn" title="Add to wishlist">&#x2764;</button>
                    </form>

                @else

                    <form method="GET" action="{{route('product.remove', $product->slug)}}">
                        @csrf
                        <button class="fa fa-trash single-btn" title="Remove from wishlist"></button>
                    </form>

                @endif

            @endauth
            </span>
            <span>
                <button class="single-btn" title="Watch Trailer"onclick="document.getElementById('myModal').style.display='block'">&#x25b6; Play Trailer</button>
            </span>
        </span>

            <span>Duration: {{$product->duration}}</span>

        <br>
        <span>PLOT:</span>
        <p class="font-new">
            {{$product->plot}}
        </p>
        <span>ACTORS: </span>

        <span>
            @foreach($product->actors as $actor)

                <span class="commas font-new"> <strong>{{$actor->name}}</strong> as {{$actor->pivot->character}}</span>

            @endforeach
        </span>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="trailer">
            <iframe id="myFrame" class="video" width="640" height="480" src="{{$product->embed_trailer}}" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
                <span class="close"
                onclick="closeTrailer()"
                >CLOSE &times;</span>
            </div>
        </div>
    </div>
</div>
<div class="comments">
    @comments(['model' => $product])
</div>
@endsection

@section('script')
<script>
    function closeTrailer() {
        document.getElementById("myFrame").src = document.getElementById("myFrame").src;
        document.getElementById('myModal').style.display='none'
    }
</script>
@endsection
