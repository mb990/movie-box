<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchRequest;
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

    public function index(ProductSearchRequest $request) {

        $query = strtolower($request->input('search'));

        $data = $this->productSearchService->getSearchedData($query, $request->input('search-type'));

        $title = 'Search results';

        return view('products.main', compact(['title', 'data']));
    }
}
