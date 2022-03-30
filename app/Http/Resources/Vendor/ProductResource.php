<?php

namespace App\Http\Resources\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'vendor_id'=>$this->vendor_id,
            'category_id'=>$this->category_id,
            'sub_category_id'=>$this->sub_category_id,
            'brand_id'=>$this->brand_id,
            'product_type_id'=>$this->product_type_id,
            'product_type_model_id'=>$this->product_type_model_id,
            'product_type_model_color_id'=>$this->product_type_model_color_id,
            'product_type_model_size_id'=>$this->product_type_model_size_id,
            'cost_price'=>$this->cost_price,
            'profit_rate'=>$this->profit_rate,
            'sell_price'=>$this->sell_price,
            'discount'=>$this->discount,
            'status'=>$this->status,
        ];
    }
}
