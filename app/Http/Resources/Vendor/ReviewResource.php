<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\General\BrandResource;
use App\Http\Resources\General\CategoryResource;
use App\Http\Resources\General\Product\ProductTypeMediaResource;
use App\Http\Resources\General\Product\ProductTypeModelColorResource;
use App\Http\Resources\General\Product\ProductTypeModelResource;
use App\Http\Resources\General\Product\ProductTypeModelSizeResource;
use App\Http\Resources\General\Product\ProductTypeResource;
use App\Http\Resources\General\SubCategoryResource;
use App\Http\Resources\VendorResource;
use App\Models\Category;
use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'customer_id'=>$this->customer_id,
            'Customer'=>new CustomerResource($this->customer),
            'order_id'=>$this->order_id,
            'product_id'=>$this->product_id,
            'rate'=>$this->rate,
            'review'=>$this->review,
        ];
    }
}
