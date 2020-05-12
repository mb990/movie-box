<?php


namespace App\Repositories;

use App\Actor;

class ActorRepository
{
    protected $actor;

    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function all() {

        return $this->actor->all();
    }

    public function allPaginated($perPage)
    {
        return $this->actor->orderBy('name')
            ->paginate($perPage);
    }

    public function findByImdb($id) {

        return $this->actor->where('imdb_id', '=', $id)->first();
    }

    public function findBySlug($slug) {

        return $this->actor->where('slug', '=', $slug)->first();
    }

    public function store($data) {

        return $this->actor->create([
            'name' => $data->actor,
            'imdb_id' => $data->actor_id
        ]);
    }

    public function addMovie(Actor $actor, $movie, $character) {

        $actor->movies()->attach($movie, ['character' => $character]);
    }
}
