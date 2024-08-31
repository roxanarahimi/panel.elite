<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->image ? $thumb = str_replace('.','_thumb.',$this->image) : $thumb = '';
        return [
            "id" => (string)$this->id,
            "index" => $this->index,
            "image" => $this->image,
            "thumb" => $thumb,
            "title" => $this->title,
            "title_en" => $this->title_en,
            "title_ar" => $this->title_ar,
            "subTitle" => $this->subTitle,
            "subTitle_en" => $this->subTitle_en,
            "subTitle_ar" => $this->subTitle_ar,
            "link" => $this->link,
            "active" => (boolean)$this->active,
            "created_at" => date('Y-m-d', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d', strtotime($this->updated_at)),
        ];
    }
}
