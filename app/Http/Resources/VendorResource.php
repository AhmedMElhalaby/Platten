<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'country_id'=>$this->country_id,
            'city_id'=>$this->city_id,
            'email'=>$this->email,
            'name'=>$this->name,
            'mobile'=>$this->mobile,
            'nickname'=>$this->nickname,
            'company_name'=>$this->company_name,
            'postcode'=>$this->postcode,
            'address'=>$this->address,
            'address_alt'=>$this->address_alt,
            'maroof_tax_number'=>$this->maroof_tax_number,
            'maroof_company_number'=>$this->maroof_company_number,
            'avatar'=>$this->avatar,
            'cover'=>$this->cover,
        ];
    }
}
