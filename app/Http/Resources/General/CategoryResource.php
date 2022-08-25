<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>asset($this->image),
            'SubCategories'=> SubCategoryBasicResource::collection($this->sub_categories)
        ];
    }
}
