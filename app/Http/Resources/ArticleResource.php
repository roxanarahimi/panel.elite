<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $thumb = $this->image ? str_replace('.jpg','_thumb.jpg',$this->image) : '';
        return [
            "id" => (string)$this->id,
            "image" => $this->image,
            "image2" => $this->image2,
            "thumb" => $thumb,
            "title" => $this->title,
            "stock" => $this->stock,
            "active" => (boolean)$this->active,
            "text" => $this->text,
            "text2" => $this->text2,
            "text3" => $this->text3,
            "text4" => $this->text4,
            "category" => [
                'id' => $this->category->id,
                'title' => $this->category->title,
                'active' => $this->category->active,
            ],
            "tags" => $this->tags,
            "views" => $this->views,
            "likes" => $this->likes,
            "dislikes" => $this->dislikes,
            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),

        ];
    }
}
