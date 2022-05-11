<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
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
        $Customers = new Customer();
        if ($this->filled('q')) {
            $Customers = $Customers->where('name','Like','%'.$this->q.'%');
        }
        $Customers = $Customers->paginate($this->per_page??10);
        return $this->success_response([],
        [
            'Customers'=>CustomerResource::collection($Customers->items())
        ],
        [
            'Customers'=>$Customers
        ]);
    }
}
