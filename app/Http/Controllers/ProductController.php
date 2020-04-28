<?php

namespace App\Http\Controllers;

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

        $data = $this->productService->getData('trending');

        $recommended = $this->productService->getRecommendedMovieData();

//        dd(auth()->user()->hasProduct($recommended['data']));
        return view('pavle/trend')
            ->with('recommended', $recommended)
            ->with('data', $data);
    }

    public function new() {

        $data = $this->productService->getData('new');

        $recommended = $this->productService->getRecommendedMovieData();

        return view('pavle/trend')
            ->with('recommended', $recommended)
            ->with('data', $data);
    }

    public function topRated() {

        $data = $this->productService->getData('topRated');

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

        $movies = $this->productService->processSearch($query);

        if (empty($query)) {

            return Redirect::to('/')
                ->withErrors(['Type something into search', 'The Message']);
        }

        else if (!empty($movies)) {

            return view('products.results')
                ->with('movies', $movies);
        }

        return Redirect::to('/')
            ->withErrors(['No results', 'The Message']);
    }

    public function addMovie(UserRequest $request, $slug){

        $product = $this->productService->findBySlug($slug);

        $this->productService->addToWishlist($product);

        return Redirect::back();
    }

    public function removeMovie(UserRequest $request, $slug) {

        $product = $this->productService->findBySlug($slug);

        $this->productService->removeFromWishlist($product);

        return Redirect::back();
    }
}
