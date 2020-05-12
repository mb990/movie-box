@extends('layouts.master')
@section('title', '')

@section('main')
<div class="movies-list">
    <span class="movie-name center">All actors</span>

    @if($errors->any())
        <h4 class="no-results">{{$errors->first()}}</h4>

    @endif

    <ul class="all-movies-list">



        <a class="no-underline movie-link" href="/"><li>Actor name</li></a>


    </ul>
    <div class="center">
    {{$products->links()}}
    </div>

</div>
@endsection
