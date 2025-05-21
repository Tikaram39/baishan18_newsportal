<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Models\Company;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function company()
    {
        $company = Company::first();
        return new CompanyResource($company);
    }

    public function categories()
    {
        $categories = Category::where('status', true)->get();
        return CategoryResource::collection($categories);
        // return new CategoryResource($categories);
    }

    public function trending_articles()
    {
        $trending_articles = Article::orderBy('views', 'desc')->where('status', 'approved')->limit(8)->get();
        return ArticleResource::collection($trending_articles);
    }

    public function category_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $category = new Category();
        $category->title = $request->name;
        $category->slug = Str::slug($request->name);
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_description = $request->meta_description;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully'
        ]);
    }
}
