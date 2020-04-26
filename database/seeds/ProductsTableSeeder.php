<?php

use Illuminate\Database\Seeder;
use App\Services\productService;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function run()
    {
//        factory(App\Product::class, 100)->create();

        $queries = ['terminator', 'hulk', 'matrix', 'rambo',
                    'rocky', 'avatar', 'saw'];

        foreach ($queries as $query) {

            $this->productService->processSearch($query);
        }
    }
}
