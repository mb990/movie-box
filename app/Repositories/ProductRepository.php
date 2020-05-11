<?php


namespace App\Repositories;

use App\Product;
use function foo\func;

class ProductRepository {
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all() {

        return $this->product->all();
    }

    public function allPaginated($perPage) {

        return $this->product->orderBy('title')
            ->paginate($perPage);
    }

    public function trending($request) {

        return $this->product->withCount('users')
            ->orderBy('users_count', 'desc')
            ->paginate(intval($request['per_page']));
    }

    public function new($request) {

        return $this->product->orderBy('year', 'desc')
            ->paginate(intval($request['per_page']));
    }

    public function topRated($request) {

        return $this->product->orderBy('rating', 'desc')
            ->paginate(intval($request['per_page']));
    }

    public function filteredData($request, $sortingColumn, $sortingOrder) {

        return $this->product->when($request->min_rating, function ($q, $minRating) {
            $q->where('rating', '>=', $minRating);
        })
            ->when($request->max_rating, function ($q, $maxRating) {
                $q->where('rating', '<=', $maxRating);
        })
            ->when($request->min_year, function ($q, $minYear) {
                $q->where('year', '>=', $minYear);
        })
            ->when($request->max_year, function ($q, $maxYear) {
                $q->where('year', '<=', $maxYear);
        })
            ->orderBy($sortingColumn, $sortingOrder)
            ->paginate(intval($request['per_page']));

//        return $this->product->whereBetween('rating', [floatval($request->min_rating), floatval($request->max_rating)])
//            ->whereBetween('year', [(intval($request->min_year)), (intval($request->max_year))])
//            ->orderBy($sortingColumn, $sortingOrder)
//            ->paginate(intval($request['per_page']));
    }

    public function find($id) {

        return $this->product->find($id);
    }

    public function findBySlug($slug) {

        return $this->product->where('slug', '=', $slug)->firstOrFail();
    }

    public function findByImdb($id) {

        return $this->product->where('imdb_id', '=', $id)->first();
    }

    public function store($data, $video) {

        return $this->product->create([
           'title' => $data->title,
           'year' => $data->year,
           'duration' => $data->length,
           'rating' => preg_replace("/[^0-9.]/", '', $data->rating),
           'plot' => $data->plot,
           'image' => $data->poster,
           'imdb_id' => $data->id,
           'rating_votes' => $data->rating_votes,
           'trailer' => $data->trailer->link,
           'embed_trailer' => $video
        ]);
    }

    public function mainActors($product) {

        return $product->actors()
            ->limit(2)
            ->get();
    }

    public function recommendedMovie() {

        return $this->product->withCount('users')
            ->orderBy('users_count', 'desc')
            ->first();
    }
}
