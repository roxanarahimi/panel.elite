<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\ProductResource;
use App\Models\Article;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Lcobucci\JWT\Exception;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            if ($request['term'] != '') {
                $products = Product::where('title', 'Like', '%' . $request['term'] . '%')->where('active', 1)->get();
                $articles = Article::where('title', 'Like', '%' . $request['term'] . '%')->where('active', 1)->get();
                $blogs = Blog::where('title', 'Like', '%' . $request['term'] . '%')->where('active', 1)->get();
                return response([
                    "products" => ProductResource::collection($products),
                    "articles" => ArticleResource::collection($articles),
                    "blogs" => BlogResource::collection($blogs)
                ], 200);
            } else {
                return response([], 200);
            }
        } catch (Exception $exception) {
            return response($exception);
        }
    }
}
