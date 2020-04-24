<?php

use Illuminate\Database\Seeder;
use App\Genre;
use App\Product;

class GenreProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $products = Product::all();


        foreach ($products as $product) {

            $genres = Genre::all()->pluck('id')->toArray();

//            $times = range(1, rand(1,3));
//
//            foreach ($times as $time) {

                $genre = array_rand($genres);

                $product->genres()->attach($genre + 1);


//                unset($genre, $genres);
//            }

//            $genres = Genre::all()->pluck('id')->toArray();
        }
    }
}
