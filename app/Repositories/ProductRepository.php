<?php


namespace App\Repositories;

use App\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all() {

        return $this->product->all();
    }

    public function allPaginated($perPage) {

        return $this->product->paginate($perPage);
    }

    public function trending($perPage) {

        return $this->product->withCount('users')
            ->orderBy('users_count', 'desc')
            ->paginate($perPage);
    }

    public function new($perPage) {

        return $this->product->orderBy('year', 'desc')
            ->paginate($perPage);
    }

    public function topRated($perPage) {

        return $this->product->orderBy('rating', 'desc')
            ->paginate($perPage);
    }

    public function filteredData($request, $perPage) {

        return $this->product->whereBetween('rating', [intval($request->min_rating), intval($request->max_rating)])
            ->whereBetween('year', [intval($request->min_year), intval($request->max_year)])
            ->orderBy('year', $request['sort_year'])
            ->orderBy('rating', $request['sort_rating'])
            ->paginate($perPage);
    }

    public function search($query) {

        return $this->product->where('title', 'like', '%' . $query . '%')
            ->get();
    }

    public function find($id) {

        return $this->product->find($id);
    }

    public function findBySlug($slug) {

        return $this->product->where('slug', '=', $slug)->first();
    }

    public function findByImdb($id) {

        return $this->product->where('imdb_id', '=', $id)->first();
    }

    public function store($data, $video) {

        return $this->product->create([
           'title' => $data->title,
           'year' => $data->year,
           'duration' => $data->length,
           'rating' => $data->rating,
           'plot' => $data->plot,
           'image' => $data->poster,
           'imdb_id' => $data->id,
           'rating_votes' => $data->rating_votes,
           'trailer' => $data->trailer->link,
           'embed_trailer' => $video
        ]);
    }

    public function mainActors($product) {

        return $product->actors()->limit(2)->get();
    }

    public function addToWishlist($product, $user) {

        $product->users()->attach($user->id);
    }

    public function removeFromWishlist($product, $user) {

        $product->users()->detach($user->id);
    }

    public function recommendedMovie() {

        return $this->product->withCount('users')
            ->orderBy('users_count', 'desc')
            ->first();
    }
}
