<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToWishlistRequest;
use App\Http\Requests\FilterProductsRequest;
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

    public function index() {

        $data = $this->productService->getData(12, 'trending');

        $recommended = $this->productService->getRecommendedMovieData();

//        dd(auth()->user()->hasProduct($recommended['data']));
        return view('pavle/trend')
            ->with('recommended', $recommended)
            ->with('data', $data);
    }

    public function new() {

        $data = $this->productService->getData('12', 'new');

        $recommended = $this->productService->getRecommendedMovieData();

        return view('pavle/trend')
            ->with('recommended', $recommended)
            ->with('data', $data);
    }

    public function topRated() {

        $data = $this->productService->getData('12', 'topRated');

        $recommended = $this->productService->getRecommendedMovieData();

        return view('pavle/trend')
            ->with('recommended', $recommended)
            ->with('data', $data);
    }

    public function showSingle($slug) {

        $product = $this->productService->findBySlug($slug);

        return view('pavle.single')->with('product', $product);
    }

    public function search(Request $request) {

        $query = $request->input('search');

        $data = $this->productService->getSearchedData($query);

        $recommended = $this->productService->getRecommendedMovieData();

        if (empty($query)) {

            return Redirect::to('/')
                ->withErrors(['Type something into search', 'The Message']);
        }

        else if (!empty($data)) {

            return view('pavle.trend')
                ->with('recommended', $recommended)
                ->with('data', $data);
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

        $data = $this->productService->getData(12, 'filteredData', $request);

        $recommended = $this->productService->getRecommendedMovieData();

        return view('pavle.trend')
            ->with('data', $data)
            ->with('recommended', $recommended);
    }
}
