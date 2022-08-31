<?php

namespace App\Http\Resources\Customer;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'avatar'=>asset($this->avatar),
            'created_at'=>Carbon::parse($this->created_at)->format('d M, Y H:i A'),
            'is_active'=>$this->is_active
        ];
    }
}
