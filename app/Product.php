<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Laravelista\Comments\Commentable;

class Product extends Model
{
    use Sluggable, Commentable;

    protected $fillable = [

        'title', 'year', 'duration', 'rating', 'image', 'imdb_id', 'plot', 'rating_votes', 'slug', 'trailer', 'embed_trailer'
        ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }

//    public function type() {
//
//        return $this->belongsTo(Type::class);
//    }

    public function users() {

        return $this->belongsToMany(User::class, 'wishlist')->withTimestamps();
    }

    public function genres() {

        return $this->belongsToMany(Genre::class, 'genre_product')->withTimestamps();
    }

    public function actors() {

        return $this->belongsToMany(Actor::class, 'actor_product')
            ->withPivot('character')
            ->withTimestamps();
    }
}
