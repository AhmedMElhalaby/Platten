<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'category_id'=>$this->category_id,
            'Category'=>new CategoryResource($this->category),
            'Brands'=>BrandBasicResource::collection($this->brands)
        ];
    }
}
