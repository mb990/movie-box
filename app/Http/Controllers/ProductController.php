<?php

namespace App\Http\Controllers;

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

        $data = $this->productService->getData('topRated');

        return view('pavle/master')
            ->with('data', $data);
    }

    public function showSingle($slug) {

        $product = $this->productService->findBySlug($slug);

        return view('products.single')->with('product', $product);
    }

    public function search(Request $request) {

        $query = $request->input('search');

        $movies = $this->productService->processSearch($query);

        if (!empty($movies)) {

            return view('products.results')
                ->with('movies', $movies);
        }
        else if (empty($query)) {

            return Redirect::to('/')
                ->withErrors(['Type something into search', 'The Message']);
        }

        return Redirect::to('/')
            ->withErrors(['No results', 'The Message']);
    }

    public function addMovie($slug){

        $product = $this->productService->findBySlug($slug);

        $this->productService->addToWishlist($product);

        return Redirect::back();
    }
}
