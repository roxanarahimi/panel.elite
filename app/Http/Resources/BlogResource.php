<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $thumb = $this->image ? str_replace('.png','_thumb.png', $this->image) : '';
        return [
            "id" => (string)$this->id,
            "image" => $this->image,
            "thumb" => $thumb,
            "title" => $this->title,
            "title_en" => $this->title_en,
            "title_ar" => $this->title_ar,
            "active" => (boolean)$this->active,
            "text" => $this->text,
            "text_en" => $this->text_en,
            "text_ar" => $this->text_ar,

//            "product" => new ProductResource($this->product),
//            "product"=> $this->product,
            "category" => [
                'id' => $this->category->id,
                'title' => $this->category->title,
                'title_en' => $this->category->title_en,
                'title_ar' => $this->category->title_ar,
                'active' => $this->category->active,
            ],
            "views" => $this->views,
            "likes" => $this->likes,
            "dislikes" => $this->dislikes,
            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),

        ];
    }
}
