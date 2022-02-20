<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:vendors,email|max:255',
            'password'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Vendor.email'),
            'password'=>__('models.Vendor.password'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = (new Vendor())->where('email',$this->email)->first();
        if (!Hash::check($this->password,$Vendor->password))
            return $this->fail_response([__('auth.failed')]);
        DB::table('oauth_access_tokens')->where('user_id', $Vendor->id)->delete();
        $tokenResult = $Vendor->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();
        return $this->success_response([],[
            'Vendor'=>new VendorResource($Vendor),
            'Login'=>[
                'token_type'=>'Bearer',
                'access_token'=>$tokenResult->accessToken
            ]
        ]);
    }
}
