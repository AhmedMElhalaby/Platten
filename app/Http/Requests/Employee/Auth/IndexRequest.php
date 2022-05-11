<?php

namespace App\Http\Requests\Employee\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use function __;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Employees = new Employee();
        if ($this->filled('q')) {
            $Employees = $Employees->where('name','Like','%'.$this->q.'%');
        }
        $Employees = $Employees->paginate($this->per_page??10);
        return $this->success_response([],
        [
            'Employees'=>EmployeeResource::collection($Employees->items())
        ],
        [
            'Employees'=>$Employees
        ]);
    }
}
