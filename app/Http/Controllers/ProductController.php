<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index() {

        $products = $this->productService->all();

        return view('homepage')
            ->with('products', $products);
    }

    public function showSingle($slug) {

        $product = $this->productService->findBySlug($slug);

        return view('products.single')->with('product', $product);
    }

    public function search(Request $request) {

        $movies = $this->productService->processSearch($request);

        return view('products.results')
            ->with('movies', $movies);
    }
}
