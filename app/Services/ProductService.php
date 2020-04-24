<?php


namespace App\Services;

use App\Repositories\ProductRepository;
use App\Services\ApiService;
use Illuminate\Support\Facades\Http;

class ProductService
{
    protected $product;
    protected $apiService;

    public function __construct(ProductRepository $product, ApiService $apiService)
    {
        $this->product = $product;
        $this->apiService = $apiService;
    }

    public function all() {

        return $this->product->all();
    }

    public function allPaginated($perPage) {

        return $this->product->allPaginated($perPage);
    }

    public function findByImdb($id) {

        return $this->product->findByImdb($id);
    }

    public function store($data) {

        return $this->product->store($data);
    }

    public function getSearchResults($request) {

        $query = $request->input('search');

        $results = $this->apiService->search($query);

        return $results;
    }

    public function processSearch($request) {

        $movies = [];

        foreach ($this->getSearchResults($request)->titles as $movie) {

            $result = $this->apiService->find($movie->id);

            if ($result->title != '') {

                if (!$this->findByImdb($result->id)) {

                    $this->store($result);
                }

                $movies[] = $this->findByImdb($result->id);
            }
        }

        return $movies;
    }
}
