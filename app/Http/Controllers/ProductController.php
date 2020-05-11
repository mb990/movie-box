<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterProductsRequest;
use App\Http\Requests\GetProductsRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(GetProductsRequest $request) {

        $data = $this->productService->getData( 'trending', $request);

        $title = 'Trending';

        return view('products.main', compact(['title', 'data']));
    }

    public function new(GetProductsRequest $request) {

        $data = $this->productService->getData('new', $request);

        $title = 'New arrivals';

        return view('products.main', compact(['title', 'data']));
    }

    public function topRated(GetProductsRequest $request) {

        $data = $this->productService->getData('topRated', $request);

        $title = 'Top rated';

        return view('products.main', compact(['title', 'data']));
    }

    public function showSingle($slug) {

        $product = $this->productService->findBySlug($slug);

        $title = $product->title;

        return view('products.single', compact(['title', 'product']));
    }

    public function showFiltered(FilterProductsRequest $request) {

        $data = $this->productService->getData( 'filteredData', $request);

        $title = 'Filtered';

        return view('products.main', compact(['title', 'data']));
    }

    public function showList()
    {
        $products = $this->productService->allPaginated(112);

        $title = 'All movies';

        return view('products.movies', compact(['products' ,'title']));
    }
}
