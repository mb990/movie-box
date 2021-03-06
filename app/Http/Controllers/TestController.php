<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Services\ActorService;
use App\Services\ProductService;
use App\Services\ApiService;

class TestController extends Controller
{

    protected $actorService;
    protected $productService;
    protected $apiService;

    public function __construct(ActorService $actorService, ProductService $productService, ApiService $apiService)
    {
        $this->actorService = $actorService;
        $this->productService = $productService;
        $this->apiService = $apiService;
    }

    public function test()
    {

        $product = $this->productService->findBySlug('hulk');

        $link = $this->productService->embedVideo($product->trailer);
        dd($link);

        return view("test");
    }

}
