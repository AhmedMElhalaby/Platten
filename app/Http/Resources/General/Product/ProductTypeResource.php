<?php

namespace App\Http\Resources\General\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'sub_category_id'=>$this->sub_category_id,
            'brand_id'=>$this->brand_id,
            'name'=>$this->name,
        ];
    }
}
