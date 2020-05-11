<?php


namespace App\Repositories;


use App\Product;
use Illuminate\Support\Facades\DB;

class ProductSearchRepository {

    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function search($query) {

        return $this->product->where('title', 'like', '%' . $query . '%')
            ->orderBy('year')
            ->get();
    }
}
