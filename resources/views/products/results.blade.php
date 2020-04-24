@extends('layouts.app')

@section('content')

    @if(!empty($movies))

        @foreach($movies as $movie)

            <a href="{{route('product.single', $movie->slug)}}"><p>{{$movie->title}}</p></a>
            <img width="320" height="180" src="{{$movie->image}}" alt="">

        @endforeach

    @endif

@endsection
