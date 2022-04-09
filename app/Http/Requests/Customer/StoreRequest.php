<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|exists:customers,id|max:255',
            'password'=>'required|string|min:8|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Customer.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = new Customer();
        $Customer->name = $this->name;
        $Customer->email = $this->email;
        $Customer->password = $this->password;
        $Customer->save();
        $Customer->refresh();
        return $this->success_response([__('messages.created_successful')],['Customer'=>new CustomerResource($Customer)]);
    }
}
