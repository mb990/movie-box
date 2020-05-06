@extends('layouts.master')
@section('title', '')
@section('main-top')
<h1 class='wishlist'>Your Wishlist</h1>
@endsection

@section('main')
<div class="all-movies">
    @forelse(auth()->user()->products as $product)

    <div class="box">
                <a href="{{route('product.single', $product->slug)}}">
                    <img src="{{ $product->image }}" class="box-picture">
                </a>
                <div class="box-info">
                    <div class="box-name">
                        <label for="boxPicture">{{substr($product->title, 0, 20)}}@if(strlen($product->title) > 20)...@endif</label>
                        <span class="actors font-new">

                            @if(!empty($data['actors'][$product->slug]))

                                {{$data['actors'][$product->slug]->implode('name', ', ')}}

                            @endif
                        </span>
                    </div>

                    @auth()

                    @if(!auth()->user()->hasProduct($product))

                        <form method="GET" action="{{route('product.add', $product->slug)}}">
                            @csrf
                            <button type="submit" class="wishlist-box-btn box-rating" title="Add to wishlist">&#x2764;</button>
                        </form>
                    @else

                        <form method="GET" action="{{route('product.remove', $product->slug)}}">
                            @csrf
                            <button type="submit" title="Remove from wishlist" class="fa fa-trash trash"></button>
                        </form>

                    @endif

                @endauth

                    <div class="box-rating help" title="based on {{$product->rating_votes}} reviews">{{$product->rating}}</div>
                </div>
            </div>
    @empty

        <p>You dont have items in wishlist.</p>

    @endforelse
</div>
@endsection
