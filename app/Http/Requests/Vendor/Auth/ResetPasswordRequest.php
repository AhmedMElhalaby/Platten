<?php

namespace App\Http\Requests\Vendor\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\ResetPassword;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;

class ResetPasswordRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:vendors,email|max:255',
            'password'=>'required|confirmed|string',
            'code'=>'required|string|min:5|max:5'
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Vendor.email'),
            'password'=>__('models.Vendor.password'),
            'password_confirmation'=>__('models.Vendor.password_confirmation'),
            'code'=>__('models.Vendor.code'),
        ];
    }
    public function run(): JsonResponse
    {
        $Vendor = (new Vendor())->where('email',$this->email)->first();
        $ResetPassword = (new ResetPassword())
            ->where('ref_type',ResetPassword::RefTypes['Vendor'])
            ->where('ref_id',$Vendor->id)->first();
        if ($ResetPassword->code == $this->code){
            $Vendor->password = Hash::make($this->password);
            $Vendor->save();
            return $this->success_response([]);
        }else{
            return $this->fail_response([__('auth.code_not_correct')]);
        }
    }
}
