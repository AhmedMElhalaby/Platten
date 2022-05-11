<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'old_password'=>'required|string|min:8|max:255',
            'password'=>'required|confirmed|string|min:8|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'old_password'=>__('models.Employee.old_password'),
            'password'=>__('models.Employee.password'),
            'password_confirmation'=>__('models.Employee.password_confirmation'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employee = (new Employee())->find(auth('employee')->user()->id);
        if(Hash::check($this->old_password,$Employee->password)){
            $Employee->password = Hash::make($this->password);
            $Employee->save();
            $Employee->refresh();
            return $this->success_response([__('messages.updated_successful')],['Employee'=>new EmployeeResource($Employee)]);
        }
        return $this->fail_response([__('auth.password_not_correct')]);
    }
}
