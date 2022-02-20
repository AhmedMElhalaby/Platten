<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Vendor.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = new Vendor();
        $Vendor->name = $this->name;
        $Vendor->save();
        $Vendor->refresh();
        return $this->success_response([__('messages.created_successful')],new VendorResource($Vendor),'Vendor');
    }
}
