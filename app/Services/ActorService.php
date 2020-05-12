<?php


namespace App\Services;

use App\Repositories\ActorRepository;

class ActorService
{
    protected $actor;

    public function __construct(ActorRepository $actor)
    {
        $this->actor = $actor;
    }

    public function all() {

        return $this->actor->all();
    }

    public function allPaginated($perPage)
    {
        return $this->actor->allPaginated($perPage);
    }

    public function findByImdb($id) {

        return $this->actor->findByImdb($id);
    }

    public function findBySlug($slug) {

        return $this->actor->findBySlug($slug);
    }

    public function store($data) {

        return $this->actor->store($data);
    }

    public function addMovie($actor, $movie, $character) {

        return $this->actor->addMovie($actor, $movie, $character);
    }

    public function actorExists($actor) {

        if (!$this->findByImdb($actor->actor_id)) {

            $actor = $this->store($actor);
        }

        else {

            $actor = $this->findByImdb($actor->actor_id);
        }

        return $actor;
    }

    public function processActors($result, $movie) {

        foreach ($result->cast as $actor) {

            $character = $actor->character;

            $actor = $this->actorExists($actor);

            $this->addMovie($actor, $movie, $character);
        }
    }
}
