<?php

namespace App\Http\Requests\Vendor\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use function auth;

class MeRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        return $this->success_response([],['Vendor'=>new VendorResource(Vendor::find(auth('vendor')->user()->id))]);
    }
}
