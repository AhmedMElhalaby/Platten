<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255',
            'password'=>'required|string|confirmed|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Vendor.name'),
            'email'=>__('models.Vendor.email'),
            'password'=>__('models.Vendor.password'),
            'password_confirmation'=>__('models.Vendor.password_confirmation'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = new Vendor();
        $Vendor->name = $this->name;
        $Vendor->email = $this->email;
        $Vendor->password = Hash::make($this->password);
        $Vendor->save();
        $Vendor->refresh();
        $tokenResult = $Vendor->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        $Vendor->refresh();
        return $this->success_response([],[
            'Vendor'=>new VendorResource($Vendor),
            'Login'=>[
                'token_type'=>'Bearer',
                'access_token'=>$tokenResult->accessToken
            ]
        ]);
    }
}
