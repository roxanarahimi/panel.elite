<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request['perPage'];
            $data = Article::orderByDesc('id')->paginate($perPage);
            $pages_count = ceil($data->total() / $perPage);
            $labels = [];
            for ($i = 1; $i <= $pages_count; $i++) {
                (array_push($labels, $i));
            }
            return response([
                "data" => ArticleResource::collection($data),
                "pages" => $pages_count,
                "total" => $data->total(),
                "labels" => $labels,
                "title" => 'مطالب',
                "tooltip_new" => 'ثبت مطلب جدید',

            ], 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function latest()
    {
        try {
            $data = Article::all()->sortByDesc('id')->take(3);
            return response(ArticleResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function show(Article $article)
    {
        try {
            return response(new ArticleResource($article), 200);
        } catch (\Exception $exception) {

            return response($exception);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:articles,title',
            ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'title.unique' => 'این عنوان قبلا ثبت شده است',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            $data = Article::create($request->except('image', 'image2'));
            if ($request['image']) {
                $name = 'article_' . $data['id'] . '_' . uniqid() . '.jpg';
                $image_path = (new ImageController)->uploadImage($request['image'], $name, 'img/');
                $data->update(['image' => '/' . $image_path]);
            }
            if ($request['image2']) {
                $name2 = 'article_' . $data['id'] . '_' . uniqid() . '.jpg';
                $image_path2 = (new ImageController)->uploadImage($request['image'], $name2, 'img/');
                $data->update(['image2' => '/' . $image_path2]);
            }

            return response(new ArticleResource($data), 201);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function update(Request $request, Article $article)
    {
//        return $request;

        $validator = Validator::make($request->all('title'),
            [
                'title' => 'required|unique:articles,title,' . $article['id'],
            ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'title.unique' => 'این عنوان قبلا ثبت شده است',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            $article->update($request->except('image', 'image2'));

            if ($request['image']) {
                $name = 'article_' . $article['id'] . '_' . uniqid() . '.jpg';
                $image_path = (new ImageController)->uploadImage($request['image'], $name, 'img/');
                $article->update(['image' => '/' . $image_path]);
            }
            if ($request['image2']) {
                $name2 = 'article_product_' . $article['id'] . '_' . uniqid() . '.jpg';
                $image_path2 = (new ImageController)->uploadImage($request['image2'], $name2, 'img/');
                $article->update(['image2' => '/' . $image_path2]);
            }
            return response(new ArticleResource($article), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

//    public function destroy(Article $article)
    public function destroy($id)
    {
        $data = Article::where('id', $id)->first();
        try {
            $data->delete();
            return response('article deleted', 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }

    public function activeToggle(Article $article)
    {

        try {
            $article->update(['active' => !$article['active']]);
            return response(new ArticleResource($article), 200);
        } catch (\Exception $exception) {
            return response($exception);
        }
    }
    public function byCat($id)
    {
        try {
            $data = Article::all()->where('article_category_id', $id);

            return response([
                "data"=>ArticleResource::collection($data),

            ], 200);
        } catch (\Exception $exception) {
            return response($exception);

        }
    }

}
