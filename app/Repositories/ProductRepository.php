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

    public function search($query) {

        return $this->product->where('title', 'like', '%' . $query . '%')
            ->get();
    }

    public function findBySlug($slug) {

        return $this->product->where('slug', '=', $slug)->first();
    }

    public function findByImdb($id) {

        return $this->product->where('imdb_id', '=', $id)->first();
    }

    public function store($data) {

        return $this->product->create([
           'title' => $data->title,
           'year' => $data->year,
           'duration' => $data->length,
           'rating' => $data->rating,
           'plot' => $data->plot,
           'image' => $data->poster,
           'imdb_id' => $data->id,
        ]);
    }
}
