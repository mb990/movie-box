<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index() {

        $products = $this->productService->allPaginated(16);

        return view('products.trending')
            ->with('products', $products);
    }

    public function showSingle($slug) {

        $product = $this->productService->findBySlug($slug);

        return view('products.single')->with('product', $product);
    }

    public function search(Request $request) {

        $movies = $this->productService->processSearch($request);

        if (!empty($movies)) {

            return view('products.results')
                ->with('movies', $movies);
        }

        return Redirect::back()
            ->withErrors(['Type something into search', 'The Message']);
    }
}
