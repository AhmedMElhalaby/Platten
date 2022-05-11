<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\Employee;
use App\Models\ResetPassword;
use Illuminate\Http\JsonResponse;
use function __;

class ForgetPasswordRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'email'=>'required|string|email|exists:employees,email|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'email'=>__('models.Employee.email'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employee = (new Employee())->where('email',$this->email)->first();
        $ResetPassword = new ResetPassword();
        $ResetPassword->ref_type = ResetPassword::RefTypes['Employee'];
        $ResetPassword->ref_id = $Employee->id;
        $ResetPassword->code = '00000';
//        $ResetPassword->code = Str::random(5);
        $ResetPassword->save();
        return $this->success_response([__('auth.code_sent')]);
    }
}
