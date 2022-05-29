<?php

namespace App\Http\Requests\Vendor\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('vendor')->check();
    }
    public function rules():array
    {
        return [
            'old_password'=>'required|string|min:6|max:255',
            'password'=>'required|confirmed|string|min:6|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'old_password'=>__('models.Vendor.old_password'),
            'password'=>__('models.Vendor.password'),
            'password_confirmation'=>__('models.Vendor.password_confirmation'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = (new Vendor())->find(auth('vendor')->user()->id);
        if(Hash::check($this->old_password,$Vendor->password)){
            $Vendor->password = Hash::make($this->password);
            $Vendor->save();
            $Vendor->refresh();
            return $this->success_response([__('messages.updated_successful')],['Vendor'=>new VendorResource($Vendor)]);
        }
        return $this->fail_response([__('auth.password_not_correct')]);
    }
}
