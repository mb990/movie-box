<?php


namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Http;

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

    public function findByImdb($id) {

        return $this->product->findByImdb($id);
    }

    public function store($data) {

        return $this->product->store($data);
    }

    public function processSearch($request) {

        $query = $request->input('search');

        $host = config('services.rapid_api.host');

        $key = config('services.rapid_api.key');

        $url = $host . '/search/' . $query;

        $request = Http::withHeaders(['x-rapidapi-key' => $key])
            ->get($url);

        $results = json_decode($request);

        $movies = [];
//dd($results);
        foreach ($results->titles as $movie) {

            $url = $host . '/film/' . $movie->id;

            $request = Http::withHeaders(['x-rapidapi-key' => $key])
                ->get($url);

            $result = json_decode($request);

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
