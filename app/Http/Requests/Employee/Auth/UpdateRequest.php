<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;
use function auth;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'employee_id'=>'required|exists:employees,id',
            'name'=>'nullable|string|max:255',
            'email'=>'nullable|string|email|unique:employees,email|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'employee_id'=>__('models.Employee.employee_id'),
            'name'=>__('models.Employee.name'),
            'email'=>__('models.Employee.email'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employee = (new Employee())->find($this->employee_id);
        if ($this->filled('name')) {
            $Employee->name = $this->name;
        }
        if ($this->filled('email')) {
            $Employee->email = $this->email;
        }
        $Employee->save();
        $Employee->refresh();
        return $this->success_response([__('messages.updated_successful')],['Employee'=>new EmployeeResource($Employee)]);
    }
}
