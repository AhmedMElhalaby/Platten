<?php

namespace App\Http\Resources\General;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'Country'=>new CountryResource($this->country)
        ];
    }
}
