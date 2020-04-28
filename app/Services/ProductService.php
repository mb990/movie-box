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

    public function trending($perPage) {

        return $this->product->trending($perPage);
    }

    public function new($perPage) {

        return $this->product->new($perPage);
    }

    public function topRated($perPage) {

        return $this->product->topRated($perPage);
    }

    public function getData($dataType) {

        $data = [];

        $data['products'] = $this->$dataType(12);

//        $data['actors'] = [];

        foreach ($data['products'] as $product) {

           $data['actors'][$product->slug] = $this->mainActors($product);
        }

        return $data;
    }

    public function getRecommendedMovieData() {

        $movie = [];

        $movie['data'] = $this->recommendedMovie();

        $movie['actors'] = $this->mainActors($movie['data']);

        return $movie;
    }

    public function search($query) {

        return $this->product->search($query);
    }

    public function checkSearchCount($data) {

        if (count($data) > 4) {

            return true;
        }

        return false;
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

        $dbSearch = $this->search($query);

        if ($this->checkSearchCount($dbSearch)) {

            foreach ($dbSearch as $movie) {

                $movies[] = $movie;
            }

            return $movies;
        }

        if ($this->getSearchResults($query) !== null) {

            foreach ($this->getSearchResults($query)->titles as $movie) {

                $result = $this->apiService->find($movie->id);

                if ($this->validateFile($result)) {

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

    public function validateFile($product) {

        $data = [
            $product->title,
            $product->year,
            $product->rating,
            $product->length,
            $product->rating_votes,
            $product->poster,
            $product->plot,
            $product->trailer->link
            ];

        foreach ($data as $field) {

            if (empty($field)) {

                return false;
            }
        }

        return true;
    }

    public function mainActors($product) {

        return $this->product->mainActors($product);
    }

    public function addToWishlist($product) {

        $user = auth()->user();

        return $this->product->addToWishlist($product, $user);
    }

    public function removeFromWishlist($product) {

        $user = auth()->user();

        return $this->product->removeFromWishlist($product, $user);
    }

    public function recommendedMovie() {

        return $this->product->recommendedMovie();
    }
}
