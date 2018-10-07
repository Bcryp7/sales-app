<?php

namespace App;

use App\Traits\isSearching;
use App\Traits\hasPagination;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use isSearching, hasPagination;

    protected $fillable = [
        'category_id',
        'code',
        'name',
        'price',
        'stock',
        'description',
        'status'
    ];

    public function category() {

        return $this->belongsTo(Category::class);

    }

    public function toggleStatus() {
        $this->status ? $this->status = 0 : $this->status = 1;
    }
}
