<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Vendor\ProductResource;
use App\Http\Resources\VendorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'product_id'=>$this->product_id,
            'Product'=>new ProductResource($this->product),
            'quantity'=>$this->quantity,
            'amount'=>$this->amount,
            'total'=>$this->total,
        ];
    }
}
