<?php


namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductService
{
    protected $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
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

    public function getData($dataType, FormRequest $request, $recommended = true) {

        $data = [];

        $data['products'] = $this->$dataType($request);

        foreach ($data['products'] as $product) {

           $data['actors'][$product->slug] = collect($this->linkToActors($this->mainActors($product)));

           $data['short_title'][$product->slug] = $this->getShortTitle($product);
        }

        if ($recommended) {

            $data['recommended'] = $this->getRecommendedMovieData();
        }

        return $data;
    }

    public function getRecommendedMovieData() {

        $movie = [];

        $movie['data'] = $this->recommendedMovie();

        $movie['actors'] = collect($this->linkToActors($this->mainActors($movie['data'])));

        return $movie;
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

    public function getShortTitle($product)
    {

        return Str::of($product->title)->limit(20);
    }

    public function linkToActors($actors)
    {

        foreach($actors as $actor) {

            $actor->name = '<a href=' . route('actor.show', $actor->slug) . '>' . $actor->name . '</a>';
        }

        return $actors;
    }
}
