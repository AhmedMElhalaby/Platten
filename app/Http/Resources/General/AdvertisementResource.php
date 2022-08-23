<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisementResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>asset($this->image),
            'url'=>$this->url,
            'type'=>$this->type,
            'order'=>$this->order,
        ];
    }
}
