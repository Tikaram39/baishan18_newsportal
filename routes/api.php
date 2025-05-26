<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/company", [ApiController::class, "company"]);
Route::get("/categories", [ApiController::class, "categories"]);
Route::get("/trending-articles", [ApiController::class, "trending_articles"]);

Route::put("/category-update/{id}", [ApiController::class, "category_update"]);
Route::delete("/category-delete/{id}", [ApiController::class, "category_delete"]);


// Auth Routes
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);


// Authenticated Routes
Route::middleware("auth:sanctum")->group(function () {
    Route::post("/category-create", action: [ApiController::class, "category_create"]);
});
