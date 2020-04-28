@extends('pavle.master')
@section('title', "Movie Name")

@section('header')
<div class="header-top header-top-wishlist">
    <div class="webName">THE MOVIE BOX</div>
    <div class="logIn"><a href=""><button class="btn-login">LOG IN</button></a></div>
    <div class="signUp"><a href=""><button class="active-color">SIGN UP</button></a></div>
</div>
@endsection

@section('main')
<div class="single-movie">
    <div class="box single-box">
    </div>
    <div class="single-info">
        <span class="movieName">MovieName (Year) 
            <span class="box-rating">4.0</span>
            <button class="wishlist-box-btn box-rating single-btn" title="Add to wishlist">&#x2764;</button>
            <button class="wishlist-box-btn box-rating single-btn" title="Watch Trailer"onclick="document.getElementById('myModal').style.display='block'">&#x25b6; Play Trailer</button>
        </span>
        <span>Duration: </span>
        <br>
        <span>PLOT:</span>
        <p>Promotion an ourselves up otherwise my. High what each snug rich far yet easy. 
            In companions inhabiting mr principles at insensible do. Heard their sex hoped enjoy vexed 
            child for. Prosperous so occasional assistance it discovered especially no. Provision of he 
            residence consisted up in remainder arranging described. 
            Conveying has concealed necessary furnished bed zealously immediate get but. Terminated as 
            middletons or by instrument. Bred do four so your felt with. No shameless principle dependent 
            household do. 
        </p>
        <span>
            Actors:
        </span>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="trailer">
                <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
            </div>
        </div>
    </div>
</div>
@endsection