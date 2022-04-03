<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'customer_id'=>$this->customer_id,
            'recipient_name'=>$this->recipient_name,
            'mobile'=>$this->mobile,
            'address'=>$this->address,
            'type'=>$this->type,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'map_address'=>$this->map_address,
        ];
    }
}
