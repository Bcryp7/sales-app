<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

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
