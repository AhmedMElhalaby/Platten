<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use App\Models\Customer;
use App\Models\ResetPassword;
use Illuminate\Http\JsonResponse;

class ForgetPasswordRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:customers,email|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Customer.email'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = (new Customer())->where('email',$this->email)->first();
        $ResetPassword = new ResetPassword();
        $ResetPassword->ref_type = ResetPassword::RefTypes['Customer'];
        $ResetPassword->ref_id = $Customer->id;
        $ResetPassword->code = '00000';
//        $ResetPassword->code = Str::random(5);
        $ResetPassword->save();
        return $this->success_response([__('auth.code_sent')]);
    }
}
