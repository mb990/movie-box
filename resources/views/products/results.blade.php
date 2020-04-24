@extends('layouts.app')

@section('content')

    @if(!empty($movies))

        @foreach($movies as $movie)

            <p>{{$movie->title}}</p>
            <img width="320" height="180" src="{{$movie->image}}" alt="">

        @endforeach

    @endif

@endsection
