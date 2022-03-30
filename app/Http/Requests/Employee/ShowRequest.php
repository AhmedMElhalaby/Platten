<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'employee_id'=>'required|exists:employees,id'
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
        return $this->success_response([],['Employee'=>new EmployeeResource(Employee::find($this->employee_id))]);
    }
}
