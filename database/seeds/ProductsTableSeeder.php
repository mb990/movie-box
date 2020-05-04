<?php

use Illuminate\Database\Seeder;
use App\Services\ProductSearchService;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    /**
     * @var ProductSearchService
     */
    private $productSearchService;

    public function __construct(ProductSearchService $productSearchService)
    {
        $this->productSearchService = $productSearchService;
    }

    public function run()
    {
//        factory(App\Product::class, 100)->create();

        $queries = ['teminator', 'hulk', 'matrix', 'rambo',
                    'rocky', 'avatar', 'saw'];

        foreach ($queries as $query) {

            $this->productSearchService->processSearch($query);
        }
    }
}
