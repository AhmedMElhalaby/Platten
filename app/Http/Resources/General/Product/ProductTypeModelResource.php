<?php

namespace App\Http\Resources\General\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeModelResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'product_type_id'=>$this->product_type_id,
            'name'=>$this->name,
        ];
    }
}
