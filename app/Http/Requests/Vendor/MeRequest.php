<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class MeRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        return $this->success_response([],['Vendor'=>new VendorResource(Vendor::find(auth('vendor')->user()->id))]);
    }
}
