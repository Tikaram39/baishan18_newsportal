<?php

use App\Http\Controllers\Api\ApiController;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/company", [ApiController::class, "company"]);
Route::get("/categories", [ApiController::class, "categories"]);
Route::get("/trending-articles", [ApiController::class, "trending_articles"]);

Route::get("/category-create", [ApiController::class, "category_create"]);
