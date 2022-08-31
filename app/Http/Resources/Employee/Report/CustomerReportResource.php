<?php

namespace App\Http\Resources\Employee\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerReportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'mobile'=>$this->mobile,
            'is_active'=>$this->is_active,
            'created_at'=>$this->created_at
        ];
    }
}
