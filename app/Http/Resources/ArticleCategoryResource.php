<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleCategoryResource extends JsonResource
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
            "title" => $this->title,
            "title_en" => $this->title_en,
            "title_ar" => $this->title_ar,
            "image" => $this->image,
            "thumb" => $thumb,
            "active" => (boolean)$this->active,

            "subsets" => ProductResource::collection($this->articles),
            "product" => $this->product,
            "article_tag" => $this->tag,
            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),
        ];
    }
}
