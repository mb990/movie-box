<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToWishlistRequest;
use App\Http\Requests\RemoveFromWishlistRequest;
use App\Services\ProductService;
use App\Services\WishlistService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WishlistController extends Controller
{
    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var WishlistService
     */
    private $wishlistService;

    public function __construct(ProductService $productService, WishlistService $wishlistService)
    {
        $this->productService = $productService;
        $this->wishlistService = $wishlistService;
    }

    public function index ()
    {
        $title = 'Wishlist';

        return view('wishlist', compact('title'));
    }

    public function addMovie(AddToWishlistRequest $request, $slug){

        $product = $this->productService->findBySlug($slug);

        $this->wishlistService->addToWishlist($product);

        return Redirect::back()->with('success', 'Item added to wishlist');
    }

    public function removeMovie(RemoveFromWishlistRequest $request, $slug) {

        $product = $this->productService->findBySlug($slug);

        $this->wishlistService->removeFromWishlist($product);

        return Redirect::back()->with('success', 'Item is removed from wishlist');
    }
}
