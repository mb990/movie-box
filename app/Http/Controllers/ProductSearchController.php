<?php

namespace App\Http\Controllers;

use App\Services\ProductSearchService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductSearchController extends Controller
{
    /**
     * @var ProductSearchService
     */
    private $productSearchService;
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductSearchService $productSearchService, ProductService $productService)
    {
        $this->productSearchService = $productSearchService;
        $this->productService = $productService;
    }

    public function index(Request $request) {

        $query = $request->input('search');

        $data = $this->productSearchService->getSearchedData($query);

        $recommended = $this->productService->getRecommendedMovieData();

        $title = 'Search results';

        if (empty($query)) { // planning to add a custom request for this purpose

            return Redirect::to('/')
                ->withErrors(['Type something into search', 'The Message']);
        }

        return view('products.main', compact(['title', 'recommended', 'data']));
    }
}
