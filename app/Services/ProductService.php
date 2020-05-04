<?php


namespace App\Services;

use App\Repositories\ProductRepository;
use App\Services\ApiService;
use App\Services\ActorService;
use App\Services\PaginationService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;

class ProductService
{
    protected $product;
    protected $apiService;
    protected $actorService;
    protected $paginationService;
    /**
     * @var ValidationService
     */
    private $validationService;

    public function __construct(ProductRepository $product, ApiService $apiService, ActorService $actorService,
                                PaginationService $paginationService, ValidationService $validationService)
    {
        $this->product = $product;
        $this->apiService = $apiService;
        $this->actorService = $actorService;
        $this->paginationService = $paginationService;
        $this->validationService = $validationService;
    }

    public function all() {

        return $this->product->all();
    }

    public function allPaginated($perPage) {

        return $this->product->allPaginated($perPage);
    }

    public function trending($request) {

        return $this->product->trending($request);
    }

    public function new($request) {

        return $this->product->new($request);
    }

    public function topRated($request) {

        return $this->product->topRated($request);
    }

    public function filteredData($request) {

        $sortingColumn = $this->getSortingData($request)['column'];

        $sortingOrder = $this->getSortingData($request)['order'];

        return $this->product->filteredData($request, $sortingColumn, $sortingOrder);
    }

    public function getData($dataType, FormRequest $request) {

        $data = [];

        $data['products'] = $this->$dataType($request);

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

    public function getSearchedData($query) {

        $data = [];

        $data['products'] = $this->processSearch($query);

        foreach ($data['products'] as $product) {

            $data['actors'][$product->slug] = $this->mainActors($product);
        }

        $data['products'] = $this->paginationService->paginate($data['products'], 8);

        return $data;
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

    public function find($id) {

        return $this->product->find($id);
    }

    public function findBySlug($slug) {

        return $this->product->findBySlug($slug);
    }

    public function findByImdb($id) {

        return $this->product->findByImdb($id);
    }

    public function store($data) {

        $video = $this->embedVideo($data->trailer->link);

        return $this->product->store($data, $video);
    }

    public function embedVideo($url) {

        $link = substr_replace($url,"embed",26, 6);

        return $link;
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

                if ($this->validationService->validateFile($result)) {

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

    public function mainActors($product) {

        return $this->product->mainActors($product);
    }

    public function recommendedMovie() {

        return $this->product->recommendedMovie();
    }

    public function getSortingData($request) {

        $sorting = [];

        $sorting ['column'] = $first = strstr($request['sorting'], " ", true);

        $sorting ['order'] = $first = ltrim(strstr($request['sorting'], " ", false), ' ');

        return $sorting;
    }
}
