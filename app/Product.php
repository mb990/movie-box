<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'year', 'duration', 'rating', 'image', 'type_id'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    public function type() {

        return $this->belongsTo(Type::class);
    }

    public function users() {

        return $this->belongsToMany(User::class, 'whishlist')->withTimestamps();
    }

    public function genres() {

        return $this->belongsToMany(Genre::class, 'genre_product')->withTimestamps();
    }
}
