<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use function __;
use function auth;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'employee_id'=>'required|exists:employees,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'employee_id'=>__('models.Employee.employee_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employee = (new Employee())->find($this->employee_id);
        $Employee->delete();
        return $this->success_response([__('messages.deleted_successfully')]);
    }
}
