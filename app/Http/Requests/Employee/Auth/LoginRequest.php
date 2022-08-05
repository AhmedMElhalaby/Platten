<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;

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
            'email'=>__('models.Employee.email'),
            'password'=>__('models.Employee.password'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employee = Employee::where('email',$this->email)->first();
        if (!Hash::check($this->password,$Employee->password))
            return $this->fail_response([__('auth.failed')]);
        $tokenResult = $Employee->createToken('Employee Token');
        $token = $tokenResult->token;
        $token->save();
        if ($this->filled('device_token') && $this->filled('device_type')){
            $Employee->device_token = $this->device_token;
            $Employee->device_type = $this->device_type;
            $Employee->save();
        }
        $Employee->refresh();
        return $this->success_response([],[
            'Employee'=>new EmployeeResource($Employee),
            'Login'=>[
                'token_type'=>'Bearer',
                'access_token'=>$tokenResult->accessToken
            ]
        ]);
    }
}
