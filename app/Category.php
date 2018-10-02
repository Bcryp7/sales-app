<?php

namespace App;

use App\Traits\isSearching;
use App\Traits\hasPagination;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use isSearching, hasPagination;

    protected $fillable = ['name', 'status', 'description'];

    public function articles() {

        return $this->hasMany(Article::class);

    }

    public function scopeActive($query) {

        return $query->whereStatus(1);

    }
}
