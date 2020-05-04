<?php


namespace App\Services;


use App\Repositories\WishlistRepository;

class WishlistService {

    /**
     * @var WishlistRepository
     */
    private $wishlistRepository;

    public function __construct(WishlistRepository $wishlistRepository)
    {
        $this->wishlistRepository = $wishlistRepository;
    }

    public function addToWishlist($product) {

        $user = auth()->user();

        return $this->wishlistRepository->addToWishlist($product, $user);
    }

    public function removeFromWishlist($product) {

        $user = auth()->user();

        return $this->wishlistRepository->removeFromWishlist($product, $user);
    }
}
