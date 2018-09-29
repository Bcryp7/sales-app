<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiArticleController extends Controller
{

    /**
     * @return array
     */
    public function index() {

        /** Uncomment if don't want to have api routes available */
        #if((! request()->ajax())) return redirect('/');

        $articleData = $this->searching();

        $articleData->load('category');

        return [

            'data' => $articleData,
            'pagination' => [

                'total' => $articleData->total(),
                'current_page' => $articleData->currentPage(),
                'per_page' => $articleData->perPage(),
                'last_page' => $articleData->lastPage(),
                'from' => $articleData->firstItem(),
                'to' => $articleData->lastItem(),

            ]

        ];

    }

    public function store(Request $request)
    {

        $article = new Article();

        $article->category_id = $request->input('category_id');
        $article->code = $request->input('code');
        $article->name = $request->input('name');
        $article->price = $request->input('price');
        $article->stock = $request->input('stock');
        $article->description = $request->input('description');
        $article->status = 1;

        $article->save();
    }

    public function update(Request $request, Article $article)
    {

        $article->category_id = $request->input('category_id') ?? $article->category_id;
        $article->code = $request->input('code') ?? $article->code;
        $article->name = $request->input('name') ?? $article->name;
        $article->price = $request->input('price') ?? $article->price;
        $article->stock = $request->input('stock') ?? $article->stock;
        $article->description = $request->input('description') ?? $article->description;

        $article->update();
    }

    public function toggleStatus(Article $article)
    {

        $article->status ? $article->status = 0 : $article->status = 1;

        $article->update();

    }

    /**
     * @return mixed
     * @internal param array|string $relations
     */
    private function searching() {

        if (request()->ajax() && request()->has('search')) {

            $modelData = Article::where(

                request()->criteria,
                'like',
                '%' . request()->input('search') . '%'

            )->orderBy('name')->paginate(2);

            return $modelData;

        }

        return Article::orderBy('name')->paginate(2);
    }
}
