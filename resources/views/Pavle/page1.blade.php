@extends('pavle.master')

@section('title', 'Trending')

@section('trending')
@foreach($products as $product)

    <div class="box">
        <div class="boxPicture"></div>
        <div class="boxInfo">
            <div class="box-name">
                <label for="boxPictures">{{$product->title}}</label>
                <span class="actors">Glumci</span>
            </div>
            <div class="box-rating">{{$product->rating}}</div>
        </div>
    </div>
@endforeach

    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>            
    <div class="box"></div>   
@endsection
