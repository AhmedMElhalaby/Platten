<?php

namespace App\Http\Resources\Customer;

use App\Http\Resources\Vendor\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FavouriteResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'customer_id'=>$this->customer_id,
            'product_id'=>$this->product_id,
            'Product'=>new ProductResource($this->product)
        ];
    }
}
