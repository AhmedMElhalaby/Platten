<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:customers,email|max:255',
            'password'=>'required|string|confirmed|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Customer.name'),
            'email'=>__('models.Customer.email'),
            'password'=>__('models.Customer.password'),
            'password_confirmation'=>__('models.Customer.password_confirmation'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = new Customer();
        $Customer->name = $this->name;
        $Customer->email = $this->email;
        $Customer->password = Hash::make($this->password);
        $Customer->save();
        $Customer->refresh();
        $tokenResult = $Customer->createToken('Customer Token');
        $token = $tokenResult->token;
        $token->save();
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
