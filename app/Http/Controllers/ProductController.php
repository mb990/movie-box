<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToWishlistRequest;
use App\Http\Requests\FilterProductsRequest;
use App\Http\Requests\GetProductsRequest;
use App\Http\Requests\RemoveFromWishlistRequest;
use App\Http\Requests\UserRequest;
use App\Services\ProductService;
use Doctrine\DBAL\Driver\IBMDB2\DB2Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use DebugBar\StandardDebugBar;
use DebugBar\DataCollector\TimeDataCollector;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(GetProductsRequest $request) {

        $data = $this->productService->getData( 'trending', $request);

        $recommended = $this->productService->getRecommendedMovieData();

        $title = 'Trending';

        return view('pavle/trend')
            ->with(compact('title'))
            ->with(compact('recommended'))
            ->with(compact('data'));
    }

    public function new(GetProductsRequest $request) {

        $data = $this->productService->getData('new', $request);

        $recommended = $this->productService->getRecommendedMovieData();

        $title = 'New arrivals';

        return view('pavle/trend')
            ->with(compact('title'))
            ->with(compact('recommended'))
            ->with(compact('data'));
    }

    public function topRated(GetProductsRequest $request) {

        $data = $this->productService->getData('topRated', $request);

        $recommended = $this->productService->getRecommendedMovieData();

        $title = 'Top rated';

        return view('pavle/trend')
            ->with(compact('title'))
            ->with(compact('recommended'))
            ->with(compact('data'));
    }

    public function showSingle($slug) {

        $product = $this->productService->findBySlug($slug);

        $title = $product->title;

        return view('pavle.single')
            ->with(compact('title'))
            ->with(compact('product'));
    }

    public function search(Request $request) {

        $query = $request->input('search');

        $data = $this->productService->getSearchedData($query);

        $recommended = $this->productService->getRecommendedMovieData();

        $title = 'Search results';

        if (empty($query)) {

            return Redirect::to('/')
                ->withErrors(['Type something into search', 'The Message']);
        }

        else if (!empty($data)) {

            return view('pavle.trend')
                ->with(compact('title'))
                ->with(compact('recommended'))
                ->with(compact('data'));
        }

        return Redirect::to('/')
            ->withErrors(['No results', 'The Message']);
    }

    public function addMovie(AddToWishlistRequest $request, $slug){

        $product = $this->productService->findBySlug($slug);

        $this->productService->addToWishlist($product);

        return Redirect::back()->with('success', 'Item added to wishlist');
    }

    public function removeMovie(RemoveFromWishlistRequest $request, $slug) {

        $product = $this->productService->findBySlug($slug);

        $this->productService->removeFromWishlist($product);

        return Redirect::back()->with('success', 'Item is removed from wishlist');
    }

    public function showFiltered(FilterProductsRequest $request) {

        $data = $this->productService->getData( 'filteredData', $request);

        $recommended = $this->productService->getRecommendedMovieData();

        $title = 'Filtered';

        return view('pavle.trend')
            ->with(compact('title'))
            ->with(compact('recommended'))
            ->with(compact('data'));
    }
}
