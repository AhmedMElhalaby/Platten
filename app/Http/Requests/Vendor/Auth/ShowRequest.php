<?php

namespace App\Http\Requests\Vendor\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use function __;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'vendor_id'=>'required|exists:vendors,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'vendor_id'=>__('models.Vendor.vendor_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],['Vendor'=>new VendorResource(Vendor::find($this->vendor_id))]);
    }
}
