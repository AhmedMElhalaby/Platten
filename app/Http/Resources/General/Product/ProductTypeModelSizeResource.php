<?php

namespace App\Http\Resources\General\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeModelSizeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'product_type_model_id'=>$this->product_type_model_id,
            'name'=>$this->name,
        ];
    }
}
