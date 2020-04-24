@extends('layouts.app')

@section('content')

    <p>{{$product->title}}</p>
    <img width="400" height="300" src="{{$product->image}}" alt="image">
@endsection
