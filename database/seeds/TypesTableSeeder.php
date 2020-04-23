<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['movie', 'tv-show'];

        foreach ($types as $type) {
            $type = new Type();

            $type->name = $types[0];

            $type->save();

            array_shift($types);
        }
    }
}
