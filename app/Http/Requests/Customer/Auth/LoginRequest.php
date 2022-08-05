<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;

class LoginRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:customers,email|max:255',
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
        $tokenResult = $Customer->createToken('Customer Token');
        $token = $tokenResult->token;
        $token->save();
        if ($this->filled('device_token') && $this->filled('device_type')){
            $Customer->device_token = $this->device_token;
            $Customer->device_type = $this->device_type;
            $Customer->save();
        }
        $Customer->refresh();
        return $this->success_response([],[
            'Customer'=>new CustomerResource($Customer),
            'Login'=>[
                'token_type'=>'Bearer',
                'access_token'=>$tokenResult->accessToken
            ]
        ]);
    }
}
