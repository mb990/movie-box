<?php


namespace App\Services;

use App\Repositories\ProductRepository;
use App\Services\ApiService;
use App\Services\ActorService;
use Illuminate\Support\Facades\Http;

class ProductService
{
    protected $product;
    protected $apiService;
    protected $actorService;

    public function __construct(ProductRepository $product, ApiService $apiService, ActorService $actorService)
    {
        $this->product = $product;
        $this->apiService = $apiService;
        $this->actorService = $actorService;
    }

    public function all() {

        return $this->product->all();
    }

    public function allPaginated($perPage) {

        return $this->product->allPaginated($perPage);
    }

    public function findBySlug($slug) {

        return $this->product->findBySlug($slug);
    }

    public function findByImdb($id) {

        return $this->product->findByImdb($id);
    }

    public function store($data) {

        return $this->product->store($data);
    }

    public function getSearchResults($query) {

        if (isset($query)) {

            $results = $this->apiService->search($query);
        }

        else {

            $results = null;
        }

        return $results;
    }

    public function processSearch($query) {

        $movies = [];

        if ($this->getSearchResults($query) !== null) {

            foreach ($this->getSearchResults($query)->titles as $movie) {

                $result = $this->apiService->find($movie->id);

                if ($result->title != '') {

                    if (!$this->findByImdb($result->id)) { // check if movie is already in db

                        $movie = $this->store($result);

                        $this->actorService->processActors($result, $movie);
                    }

                    $movies[] = $this->findByImdb($result->id);
                }
            }
        }

        return $movies;
    }
}
