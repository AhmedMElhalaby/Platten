<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use function __;
use function auth;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|exists:employees,id|max:255',
            'password'=>'required|string|min:8|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Employee.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employee = new Employee();
        $Employee->name = $this->name;
        $Employee->email = $this->email;
        $Employee->password = $this->password;
        $Employee->save();
        $Employee->refresh();
        return $this->success_response([__('messages.created_successful')],['Employee'=>new EmployeeResource($Employee)]);
    }
}
