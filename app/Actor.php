<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Actor extends Model
{
    use Sluggable;

    protected $fillable = ['name', 'imdb_id', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    public function movies() {

        return $this->belongsToMany(Product::class, 'actor_product')
            ->withPivot('character')
            ->withTimestamps();
    }
}
