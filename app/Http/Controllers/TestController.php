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

        $key = '3b3ea29688mshcc2d2156ae078bap18b3f5jsne59d77ae030e';
        $request = Http::withHeaders(
            ['x-rapidapi-key' => $key])
//            ->get('https://imdb-internet-movie-database-unofficial.p.rapidapi.com/film/tt1375666');
                ->get('https://imdb-internet-movie-database-unofficial.p.rapidapi.com/search/hulk');
        $response = json_decode($request);

        return view("test")->with("response", $response);

    }

}
