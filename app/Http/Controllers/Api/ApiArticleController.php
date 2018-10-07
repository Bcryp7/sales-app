<?php

namespace App\Http\Controllers\Api;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
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

    public function store(ArticleRequest $request)
    {
        $article = new Article($request->validated());
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

        $article->toggleStatus();

        $article->update();

    }
}
