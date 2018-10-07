<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Filters\CategoryFilters;

class ApiCategoryController extends Controller
{

    public function index() {

        /** Uncomment if don't want to have api routes available */
        #if((! request()->ajax())) return redirect('/');

        $category = new Category();

        $categoryData = $category->searching();


        return [

            'data' => $categoryData,
            'pagination' => $category->pagination($categoryData)

        ];

    }

    /**
     *  @param CategoryRequest $request
     *  @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {

        $category = new Category();

        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->status = 1;

        $category->save();
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Category $category)
    {

        /** Uncomment in case you need to restrict non ajax requests. */
        //if (! request()->ajax()) return redirect('/');

        $category->name = $request->input('name') ?? $category->name;
        $category->description = $request->input('description') ?? $category->description;

        $category->update();
    }

    /**
     *  Let me know if there's any suggestion about
     *  the location of this method, please.
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function toggleStatus(Category $category)
    {

        /** Uncomment in case you need to restrict non ajax requests. */
        //if (! request()->ajax()) return redirect('/');

        $category->toggleStatus();

        $category->update();

    }

    /** Could've done this func. in @index and save a route/method;
     *  but I decided to stick with SRP - Single Responsibility Principle
     *
     *  Let me know what you think, app's open to suggestions about good practices.
     */
    public function getActiveCategories(CategoryFilters $filter) {

        /** Uncomment in case you need to restrict non ajax requests. */
        //if (! request()->ajax()) return redirect('/');

        return [

            'data' => Category::filter($filter)
                        ->orderBy('name', 'asc')
                            ->get(['id', 'name', 'status'])

        ];

    }

}
