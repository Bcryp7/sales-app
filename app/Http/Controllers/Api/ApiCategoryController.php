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

        $categoryData = $this->searching();

        return [

            'data' => $categoryData,
            'pagination' => [

                'total' => $categoryData->total(),
                'current_page' => $categoryData->currentPage(),
                'per_page' => $categoryData->perPage(),
                'last_page' => $categoryData->lastPage(),
                'from' => $categoryData->firstItem(),
                'to' => $categoryData->lastItem(),

            ]

        ];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = 1;

        $category->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->input('name') ?? $category->name;
        $category->description = $request->input('description') ?? $category->description;

        $category->update();
    }

    public function toggleStatus(Category $category)
    {

        $category->status ? $category->status = 0 : $category->status = 1;

        $category->update();

    }

    /**
     * @return mixed
     * @internal param array|string $relations
     */
    private function searching() {

        if (request()->ajax() && request()->has('search')) {

            $modelData = Category::where(

                request()->criteria,
                'like',
                '%' . request()->input('search') . '%'

            )->orderBy('name')->paginate(2);

            return $modelData;

        }

        return Category::orderBy('name')->paginate(2);
    }

}
