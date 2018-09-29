<?php

namespace App;

use App\Traits\isSearching;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use isSearching;

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
}
