<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'vendor_id'=>'required|exists:vendors,id',
            'name'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'vendor_id'=>__('models.Vendor.vendor_id'),
            'name'=>__('models.Vendor.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = (new Vendor())->find($this->vendor_id);
        if ($this->filled('name')) {
            $Vendor->name = $this->name;
        }
        $Vendor->save();
        $Vendor->refresh();
        return $this->success_response([__('messages.updated_successful')],new VendorResource($Vendor),'Vendor');
    }
}
