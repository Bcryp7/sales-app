<?php

Route::get('/categories', 'Api\ApiCategoryController@index');
Route::get('/categories/filters', 'Api\ApiCategoryController@getActiveCategories');
Route::post('/categories', 'Api\ApiCategoryController@store');
Route::put('/categories/{category}', 'Api\ApiCategoryController@update');
Route::put('/categories/{category}/toggle-status', 'Api\ApiCategoryController@toggleStatus');

Route::get('/articles', 'Api\ApiArticleController@index');
Route::post('/articles', 'Api\ApiArticleController@store');
Route::put('/articles/{article}', 'Api\ApiArticleController@update');
Route::put('/articles/{article}/toggle-status', 'Api\ApiArticleController@toggleStatus');
