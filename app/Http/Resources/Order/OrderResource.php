<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\VendorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'customer_id'=>$this->customer_id,
            'Customer'=>new CustomerResource($this->customer),
            'vendor_id'=>$this->vendor_id,
            'Vendor'=>new VendorResource($this->vendor),
            'discount_id'=>$this->discount_id,
            'discount_amount'=>$this->discount_amount,
            'cost'=>$this->cost,
            'amount'=>$this->amount,
            'total_amount'=>$this->total_amount,
            'recipient_name'=>$this->recipient_name,
            'mobile'=>$this->mobile,
            'address'=>$this->address,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'map_address'=>$this->map_address,
            'status'=>$this->status,
            'OrderProducts'=>OrderProductResource::collection($this->orders_products)
        ];
    }
}
