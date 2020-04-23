<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = ['drama', 'action', 'comedy', 'horror', 'documentary', 'war', 'thriller', 'adventure', 'fantasy', 'mystery', 'western'];

        foreach ($genres as $genre) {
            $genre = new Genre();

            $genre->name = $genres[0];

            $genre->save();

            array_shift($genres);
        }
    }
}
