<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'customer_id'=>'required|exists:customers,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'customer_id'=>__('models.Customer.customer_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],['Customer'=>new CustomerResource(Customer::find($this->customer_id))]);
    }
}
