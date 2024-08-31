<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $thumb = $this->image ? str_replace('.png', '_thumb.png', $this->image) : '';
        return [
            "id" => (string)$this->id,
            "product_category_id" => $this->product_category_id,
            "index" => $this->index,
            "image" => $this->image,
            "thumb" => $thumb,
            "title" => $this->title,
            "title_en" => $this->title_en,
            "title_ar" => $this->title_ar,
            "subTitle" => $this->subTitle,
            "subTitle_en" => $this->subTitle_en,
            "subTitle_ar" => $this->subTitle_ar,
            "flavor" => $this->flavor,
            "flavor_en" => $this->flavor_en,
            "flavor_ar" => $this->flavor_ar,
            "tag1" => $this->tag1,
            "tag1_en" => $this->tag1_en,
            "tag1_ar" => $this->tag1_ar,
            "tag2" => $this->tag2,
            "tag2_en" => $this->tag2_en,
            "tag2_ar" => $this->tag2_ar,
            "text" => $this->text,
            "text_en" => $this->text_en,
            "text_ar" => $this->text_ar,
            "features" => $this->features,
            "features_en" => $this->features_en,
            "features_ar" => $this->features_ar,

            "color" => $this->color,
            "link" => $this->link,

            "stock" => $this->stock,
            "active" => (boolean)$this->active,
            "category" => [
                'id' => $this->category->id,
                'title' => $this->category->title,
                'title_en' => $this->category->title_en,
                'title_ar' => $this->category->title_ar,
                'active' => $this->category->active,
            ],
            "sizes" => $this->sizes,


            "price" => $this->price,
            "off" => $this->off,
            "view" => $this->view,
            "score" => $this->score,
            "score_count" => $this->score_count,
//            "views" => $this->views,
//            "likes" => $this->likes,
//            "dislikes" => $this->dislikes,
            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),


        ];
    }
}
