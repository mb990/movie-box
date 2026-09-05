<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    public function data()
    {
        return [
            'token' => config('services.tmdb.token'),
        ];
    }

    public function search($query)
    {
        $response = Http::withToken($this->data()['token'])
            ->get('https://api.themoviedb.org/3/search/movie', [
                'query' => $query,
                'language' => 'en-US',
                'include_adult' => false,
            ]);

        $results = $response->json();

        return (object) [
            'titles' => collect($results['results'] ?? [])
                ->filter(function ($movie) {
                    return !empty($movie['id']);
                })
                ->take(8)
                ->map(function ($movie) {
                    return (object) [
                        'id' => $movie['id'],
                    ];
                })
                ->values()
                ->all(),
        ];
    }

    public function find($id)
    {
        $response = Http::withToken($this->data()['token'])
            ->get("https://api.themoviedb.org/3/movie/{$id}", [
                'append_to_response' => 'credits,external_ids,videos',
                'language' => 'en-US',
            ]);

        $movie = $response->json();

        if (empty($movie['id'])) {
            return null;
        }

        $imdbId = $movie['external_ids']['imdb_id'] ?? null;

        if (!$imdbId) {
            return null;
        }

        $trailer = null;

        foreach ($movie['videos']['results'] ?? [] as $video) {
            if (
                $video['site'] === 'YouTube' &&
                $video['type'] === 'Trailer' &&
                !empty($video['key'])
            ) {
                $trailer = 'https://www.youtube.com/watch?v=' . $video['key'];
                break;
            }
        }

        if (!$trailer) {
            return null;
        }

        $cast = [];

        foreach (array_slice($movie['credits']['cast'] ?? [], 0, 5) as $actor) {
            if (empty($actor['id']) || empty($actor['name'])) {
                continue;
            }

            $actorDetails = Http::withToken($this->data()['token'])
                ->get("https://api.themoviedb.org/3/person/{$actor['id']}", [
                    'append_to_response' => 'external_ids',
                    'language' => 'en-US',
                ])
                ->json();

            $actorImdbId = $actorDetails['external_ids']['imdb_id'] ?? null;

            if (!$actorImdbId) {
                continue;
            }

            $cast[] = (object) [
                'actor' => $actor['name'],
                'actor_id' => $actorImdbId,
                'character' => $actor['character'] ?? '',
            ];
        }

        return (object) [
            'id' => $imdbId,
            'title' => $movie['title'] ?? '',
            'year' => !empty($movie['release_date'])
                ? substr($movie['release_date'], 0, 4)
                : '',
            'length' => $movie['runtime'] ?? '',
            'rating' => $movie['vote_average'] ?? '',
            'rating_votes' => $movie['vote_count'] ?? '',
            'poster' => !empty($movie['poster_path'])
                ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path']
                : '',
            'plot' => $movie['overview'] ?? '',
            'trailer' => (object) [
                'link' => $trailer,
            ],
            'cast' => $cast,
        ];
    }
}
