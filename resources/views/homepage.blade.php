@extends('layouts.app')

@section('content')

{{--    @foreach($products as $product)--}}

{{--        <p>{{$product->title}}</p>--}}
{{--        <img src="{{$product->image}}" alt="image">--}}

{{--    @endforeach--}}

<form action="{{route('search')}}">

    <input type="search" name="search" placeholder="search">

</form>

@endsection
