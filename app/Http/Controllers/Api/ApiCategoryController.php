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

        $category = new Category();

        $categoryData = $category->searching();

        return [

            'data' => $categoryData,
            'pagination' => $category->pagination($categoryData)

        ];

    }

    /**
     *  @param Request $request
     *  @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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

        $category->status ? $category->status = 0 : $category->status = 1;

        $category->update();

    }

    /** Could've done this func. in @index and save a route/method;
     *  but I decided to stick with SRP - Single Responsibility Principle
     *
     *  Let me know what you think, app's open to suggestions about good practices.
     */
    public function getActiveCategories() {

        /** Uncomment in case you need to restrict non ajax requests. */
        //if (! request()->ajax()) return redirect('/');

        return [

            'data' => Category::active()
                        ->orderBy('name', 'asc')
                            ->get(['id', 'name'])

        ];

    }

}
