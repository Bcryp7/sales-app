<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'status', 'description'];

    public function articles() {

        return $this->hasMany(Article::class);

    }
}
