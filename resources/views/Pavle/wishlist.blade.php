@extends('pavle.master')
@section('title', '')
@section('header')
<h1 class='wishlist'>Your Wihslist</h1>
@endsection

@section('main')

    @forelse(auth()->user()->products as $product)

        {{$product->title}} <br>

    @empty

        <p>You dont have items in wishlist.</p>

    @endforelse

@endsection
