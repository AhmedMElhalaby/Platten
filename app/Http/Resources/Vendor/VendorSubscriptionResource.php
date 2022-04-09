<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\General\BrandResource;
use App\Http\Resources\General\CategoryResource;
use App\Http\Resources\General\Product\ProductTypeMediaResource;
use App\Http\Resources\General\Product\ProductTypeModelColorResource;
use App\Http\Resources\General\Product\ProductTypeModelResource;
use App\Http\Resources\General\Product\ProductTypeModelSizeResource;
use App\Http\Resources\General\Product\ProductTypeResource;
use App\Http\Resources\General\SubCategoryResource;
use App\Http\Resources\General\SubscriptionResource;
use App\Http\Resources\VendorResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorSubscriptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'subscription_id'=>$this->subscription_id,
            'Subscription'=>new SubscriptionResource($this->subscription),
            'billing_type'=>$this->billing_type,
            'price'=>$this->price,
            'paid'=>$this->paid?1:0,
            'start_at'=>$this->start_at,
            'expire_at'=>$this->expire_at,
        ];
    }
}
