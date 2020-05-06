@extends('layouts.master')
@section('title', '')

@section('main')
<div class="movies-list">
Movies List

    @if($errors->any())
        <h4 class="no-results">{{$errors->first()}}</h4>

    @endif

<ul>

    @forelse($products as $product)

        <a href="{{route('product.single', $product->slug)}}"><li>{{$product->title}}</li></a>

    @empty

        No movies.

    @endforelse

</ul>


</div>
@endsection
