@extends('layouts.master')
@section('title', "")

@section('main')
<div class="movies-list">

    <span class="movie-name center">{{$actor->name}}</span>
    <span>List of movies this actor is acting: </span>
    <br>

    @forelse($actor->movies as $movie)

        <span>

            <span class="commas font-new">{{$movie->name}}</span>

        @empty

            <p>No movies.</p>

        </span>

    @endforelse

    <a href="https://google.com/search?q={{$actor->name}} wikipedia.org" class="center">Click here for more info about Actor name</a>

</div>
@endsection
