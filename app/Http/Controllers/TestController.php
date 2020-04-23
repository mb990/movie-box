<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;



class TestController extends Controller
{

    public function __construct()
    {

    }

    public function test()
    {
     
        // $response = Http::withHeaders([
        //     'x-rapidapi-host' => 'imdb-internet-movie-database-unofficial.p.rapidapi.com',
	    //     'x-rapidapi-key' => 'a1de5906e7mshe0cf46dd3e674cap1ba97ajsncdbf9fe795c4'
        // ])
        // ->setRequestUrl('https://imdb-internet-movie-database-unofficial.p.rapidapi.com/film/tt1375666')
        // ->get('/film/{query}', [
        //     'id' => 'tt1375666'
        // ]);

        $response = Http::withHeaders([
            'x-rapidapi-host' => 'imdb-internet-movie-database-unofficial.p.rapidapi.com',
	        'x-rapidapi-key' => 'a1de5906e7mshe0cf46dd3e674cap1ba97ajsncdbf9fe795c4'
        ])
        ->setRequestUrl('https://imdb-internet-movie-database-unofficial.p.rapidapi.com/film/tt1375666')
        ->post('http://localhost/movie-box/public/test', [
            'id' => 'tt1375666',
        ]);

        // return view("test")->with("response", $response);

    }
    
}
