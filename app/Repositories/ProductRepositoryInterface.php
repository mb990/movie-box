<?php

namespace App\Repositories;

interface ProductRepositoryInterface {
    public function all();

    public function allPaginated($perPage);

    public function trending($request);

    public function new($request);

    public function topRated($request);

    public function filteredData($request, $sortingColumn, $sortingOrder);

    public function search($query);

    public function find($id);

    public function findBySlug($slug);

    public function findByImdb($id);

    public function store($data, $video);

    public function mainActors($product);

    public function addToWishlist($product, $user);

    public function removeFromWishlist($product, $user);

    public function recommendedMovie();
}
