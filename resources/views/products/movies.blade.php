@extends('layouts.master')
@section('title', '')

@section('main')
<div class="movies-list">
Movies List

<ul>

    @forelse($products as $product)

        <a href="{{route('product.single', $product->slug)}}"><li>{{$product->title}}</li></a>

    @empty

        No movies.

    @endforelse

</ul>


</div>
@endsection
