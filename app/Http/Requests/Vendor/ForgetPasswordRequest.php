<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\ResetPassword;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class ForgetPasswordRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:vendors,email|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Vendor.email'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = (new Vendor())->where('email',$this->email)->first();
        $ResetPassword = new ResetPassword();
        $ResetPassword->ref_type = ResetPassword::RefTypes['Vendor'];
        $ResetPassword->ref_id = $Vendor->id;
        $ResetPassword->code = '00000';
//        $ResetPassword->code = Str::random(5);
        $ResetPassword->save();
        return $this->success_response([__('auth.code_sent')]);
    }
}
