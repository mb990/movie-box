@extends('layouts.app')

@section('content')

{{--    @foreach($products as $product)--}}

{{--        <p>{{$product->title}}</p>--}}
{{--        <img src="{{$product->image}}" alt="image">--}}

{{--    @endforeach--}}

<form action="{{route('search')}}">

    <input type="search" name="search" placeholder="search">

    <input type="submit" class="bnt btn-success">

</form>

@if($errors->any())
    <h4>{{$errors->first()}}</h4>
@endif

    @foreach($products as $product)

        <p>{{$product->title}}</p>
        <img width="400" height="300" src="{{$product->image}}">

    @endforeach

@endsection
