<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use App\Models\Customer;
use App\Models\ResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ResetPasswordRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:customers,email|max:255',
            'password'=>'required|confirmed|string',
            'code'=>'required|string|min:5|max:5'
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Customer.email'),
            'password'=>__('models.Customer.password'),
            'password_confirmation'=>__('models.Customer.password_confirmation'),
            'code'=>__('models.Customer.code'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = (new Customer())->where('email',$this->email)->first();
        $ResetPassword = (new ResetPassword())
            ->where('ref_type',ResetPassword::RefTypes['Customer'])
            ->where('ref_id',$Customer->id)->first();
        if ($ResetPassword->code == $this->code){
            $Customer->password = Hash::make($this->password);
            $Customer->save();
            return $this->success_response([]);
        }else{
            return $this->fail_response([__('auth.code_not_correct')]);
        }
    }
}
