<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{

    public function index() {

        /** Uncomment if don't want to have api routes available */
        #if((! request()->ajax())) return redirect('/');

        $categories = Category::orderBy('name')->paginate(10);

        return [

            'data' => $categories,
            'pagination' => [

                'total' => $categories->total(),
                'current_page' => $categories->currentPage(),
                'per_page' => $categories->perPage(),
                'last_page' => $categories->lastPage(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastItem(),

            ]

        ];

    }

}
