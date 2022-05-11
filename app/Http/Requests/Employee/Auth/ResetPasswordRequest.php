<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\Employee;
use App\Models\ResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;

class ResetPasswordRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:employees,email|max:255',
            'password'=>'required|confirmed|string',
            'code'=>'required|string|min:5|max:5'
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Employee.email'),
            'password'=>__('models.Employee.password'),
            'password_confirmation'=>__('models.Employee.password_confirmation'),
            'code'=>__('models.Employee.code'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employee = (new Employee())->where('email',$this->email)->first();
        $ResetPassword = (new ResetPassword())
            ->where('ref_type',ResetPassword::RefTypes['Employee'])
            ->where('ref_id',$Employee->id)->first();
        if ($ResetPassword->code == $this->code){
            $Employee->password = Hash::make($this->password);
            $Employee->save();
            return $this->success_response([]);
        }else{
            return $this->fail_response([__('auth.code_not_correct')]);
        }
    }
}
