<?php


namespace App\Repositories;

use App\Product;

class WishlistRepository {

    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addToWishlist($product, $user) {

        $product->users()->attach($user->id);
    }

    public function removeFromWishlist($product, $user) {

        $product->users()->detach($user->id);
    }

}
