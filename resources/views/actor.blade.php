@extends('layouts.master')
@section('title', "")

@section('main')
<div class="movies-list">

    <span class="movie-name center">{{$actor->name}}</span>
    <span>List of movies this actor is acting: </span>
    <br>


        <span>
            @forelse($actor->movies as $movie)

            <span class="commas font-new "><a class="pink no-underline" href="{{route('product.single', $movie->slug)}}">{{$movie->title}}</a></span>

        @empty

            <p>No movies.</p>

        </span>

    @endforelse


</div>
<div class="center">
    <a href="https://google.com/search?q={{$actor->name}} wikipedia.org" class="no-underline pink" target="blank">Click here for more info about {{$actor->name}}</a>
</div>

@endsection
