<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{

    public function index() {

        return [

            'data' => Category::orderBy('name')->get()

        ];

    }

}
