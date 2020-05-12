<?php

namespace App\Http\Controllers;

use App\Services\ActorService;
use Illuminate\Http\Request;

class ActorController extends Controller
{

    /**
     * @var ActorService
     */
    private $actorService;

    public function __construct(ActorService $actorService)
    {
        $this->actorService = $actorService;
    }

    public function index ()
    {
        $actors = $this->actorService->allPaginated(126);

        $title = 'Actors';

        return view('actors', compact(['actors', 'title']));
    }

    public function show ($slug)
    {
        $actor = $this->actorService->findBySlug($slug);

        $title = $actor->name;

        return view('actor', compact(['actor', 'title']));
    }
}
