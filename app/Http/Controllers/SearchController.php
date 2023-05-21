<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Lcobucci\JWT\Exception;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $data = Article::where('title',  'Like', '%' . $request['term'] . '%')->get();
            return response(ArticleResource::collection($data), 200);
        }catch (Exception $exception){
            return response($exception);
        }
    }
}
