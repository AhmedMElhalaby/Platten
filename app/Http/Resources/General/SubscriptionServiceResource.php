<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionServiceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'subscription_id'=>$this->subscription_id,
            'name'=>$this->name,
            'color'=>$this->color,
            'checked'=>$this->checked,
        ];
    }
}
