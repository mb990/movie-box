@extends('layouts.master')
@section('title', '')

@section('main')
<div class="movies-list">
    <span class="movie-name center">All actors</span>

    @if($errors->any())
        <h4 class="no-results">{{$errors->first()}}</h4>

    @endif

    <ul class="all-movies-list">

        @forelse($actors as $actor)

            <a class="no-underline movie-link" href="{{route('actor.show', $actor->slug)}}"><li>{{$actor->name}}</li></a>

        @empty

            <p>No actors.</p>

        @endforelse

    </ul>
    <div class="center">
    {{$actors->links()}}
    </div>

</div>
@endsection
