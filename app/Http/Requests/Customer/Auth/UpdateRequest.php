<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;
use function auth;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'nullable|string|max:255',
            'email'=>'nullable|string|email|unique:customers,email|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'customer_id'=>__('models.Customer.customer_id'),
            'name'=>__('models.Customer.name'),
            'email'=>__('models.Customer.email'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = (new Customer())->find(auth('customer')->user()->id);
        if ($this->filled('name')) {
            $Customer->name = $this->name;
        }
        if ($this->filled('email')) {
            $Customer->email = $this->email;
        }
        $Customer->save();
        $Customer->refresh();
        return $this->success_response([__('messages.updated_successful')],['Customer'=>new CustomerResource($Customer)]);
    }
}
