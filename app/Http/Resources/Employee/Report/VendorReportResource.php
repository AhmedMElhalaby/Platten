<?php

namespace App\Http\Resources\Employee\Report;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorReportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'country_name'=>$this->country->name,
            'city_name'=>$this->city->name,
            'email'=>$this->email,
            'name'=>$this->name,
            'mobile'=>$this->mobile,
            'nickname'=>$this->nickname,
            'company_name'=>$this->company_name,
            'postcode'=>$this->postcode,
            'snapchat'=>$this->snapchat,
            'twitter'=>$this->twitter,
            'instagram'=>$this->instagram,
            'facebook'=>$this->facebook,
            'website'=>$this->website,
            'maaroof_url'=>$this->maaroof_url,
            'address'=>$this->address,
            'address_alt'=>$this->address_alt,
            'maroof_tax_number'=>$this->maroof_tax_number,
            'maroof_company_number'=>$this->maroof_company_number,
            'created_at'=>Carbon::parse($this->created_at)->format('d M, Y H:i A')
        ];
    }
}
