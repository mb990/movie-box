<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Product;

class WishlistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $products = Product::all();

        foreach ($users as $user) {

            $user->products()->attach($products->random((rand(1,5))));
        }
    }
}
