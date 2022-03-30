<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'employee_id'=>'required|exists:customers,id',
            'name'=>'nullable|string|max:255',
            'email'=>'nullable|string|email|unique:customers,email|max:255',
            'password'=>'nullable|string|min:8|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'customer_id'=>__('models.Customer.customer_id'),
            'name'=>__('models.Customer.name'),
            'email'=>__('models.Customer.email'),
            'password'=>__('models.Customer.password'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = (new Customer())->find($this->customer_id);
        if ($this->filled('name')) {
            $Customer->name = $this->name;
        }
        if ($this->filled('email')) {
            $Customer->email = $this->email;
        }
        if ($this->filled('password')) {
            $Customer->password = Hash::make($this->password);
        }
        $Customer->save();
        $Customer->refresh();
        return $this->success_response([__('messages.updated_successful')],['Customer'=>new CustomerResource($Customer)]);
    }
}
