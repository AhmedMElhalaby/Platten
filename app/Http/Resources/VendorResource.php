<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VendorResource extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'name'=>$request->name,
            'email'=>$request->email,
        ];
    }
}
