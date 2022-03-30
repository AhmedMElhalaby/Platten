<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:employees,email|max:255',
            'password'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Customer.email'),
            'password'=>__('models.Customer.password'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = (new Customer())->where('email',$this->email)->first();
        if (!Hash::check($this->password,$Customer->password))
            return $this->fail_response([__('auth.failed')]);
        return $this->success_response([],[
            'Customer'=>new CustomerResource($Customer),
            'Login'=>[
                'token_type'=>'Bearer',
                'access_token'=>$Customer->createToken('Customer Token')->plainTextToken
            ]
        ]);
    }
}
