<?php


namespace App\Services;


use App\Repositories\ProductSearchRepository;

class ProductSearchService {

    /**
     * @var ProductSearchRepository
     */
    private $productSearchRepository;
    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var PaginationService
     */
    private $paginationService;
    /**
     * @var ApiService
     */
    private $apiService;
    /**
     * @var ValidationService
     */
    private $validationService;
    /**
     * @var ActorService
     */
    private $actorService;

    public function __construct(ProductSearchRepository $productSearchRepository, ProductService $productService, PaginationService $paginationService, ApiService $apiService, ValidationService $validationService, ActorService $actorService)
    {
        $this->productSearchRepository = $productSearchRepository;
        $this->productService = $productService;
        $this->paginationService = $paginationService;
        $this->apiService = $apiService;
        $this->validationService = $validationService;
        $this->actorService = $actorService;
    }

    public function search($query) {

        return $this->productSearchRepository->search($query);
    }

    public function getSearchedData($query) {

        $data = [];

        $data['products'] = $this->processSearch($query);

        foreach ($data['products'] as $product) {

            $data['actors'][$product->slug] = $this->productService->mainActors($product);

            $data['short_title'][$product->slug] = $this->productService->getShortTitle($product);
        }

        $data['products'] = $this->paginationService->paginate($data['products'], 8);

        $data['recommended'] = $this->productService->getRecommendedMovieData();

        return $data;
    }

    public function checkSearchCount($data) {

        if (count($data) > 4) {

            return true;
        }

        return false;
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

        foreach ($dbSearch as $movie) {

            $movies[] = $movie;
        }

        if ($this->checkSearchCount($dbSearch)) {

            return $movies;
        }

        if ($this->getSearchResults($query) !== null) {

            foreach ($this->getSearchResults($query)->titles as $movie) {

                $result = $this->apiService->find($movie->id);

                $movies = $this->processResults($movies, $result);
            }
        }

        return $movies;
    }

    public function processResults(array $movies, $result) {

        if ($this->validationService->validateFile($result)) {

            if (!$this->productService->findByImdb($result->id)) {

                $movie = $this->productService->store($result);

                $this->actorService->processActors($result, $movie);

                $movies[] = $this->productService->findByImdb($result->id);
            }
        }

        return $movies;
    }
}
