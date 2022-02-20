<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'vendor_id'=>'required|exists:vendors,id',
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
        $Vendor = (new Vendor())->find($this->vendor_id);
        $Vendor->delete();
        return $this->success_response([__('messages.deleted_successfully')]);
    }
}
