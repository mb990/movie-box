@extends('layouts.master')
@section('title', '')

@section('main')
<div class="movies-list">
<span class="movie-name center">All movies List</span>

    @if($errors->any())
        <h4 class="no-results">{{$errors->first()}}</h4>

    @endif

<ul>
    <ul class="all-movies-list">

        @forelse($products as $product)

            <a class="no-underline movie-link" href="{{route('product.single', $product->slug)}}"><li>{{$product->title}}</li></a>

        @empty

            No movies.

        @endforelse

    </ul>
    <div class="center">
    {{$products->links()}}
    </div>

</div>
@endsection
