<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];

    public function products() {

        return $this->belongsToMany(Product::class, 'genre_product')->withTimestamps();
    }
}
