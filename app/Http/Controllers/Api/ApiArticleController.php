<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;

class ApiArticleController extends Controller
{

    /**
     * @return array
     */
    public function index() {

        $article = new Article();

        $articleData = $article->searching();

        $articleData->load('category');

        return [

            'data' => ArticleResource::collection($articleData),
            'pagination' => $article->pagination($articleData)

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

        if (! request()->ajax()) return redirect('/');

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
}
