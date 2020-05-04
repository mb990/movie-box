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

        return view('pavle.trend')
            ->with(compact('title'))
            ->with(compact('recommended'))
            ->with(compact('data'));
//            ->withErrors(['No results', 'The Message']);
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
