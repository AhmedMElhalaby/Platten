<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Requests\ApiRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use function __;
use function auth;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'customer_id'=>'required|exists:customers,id',
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
        $Customer = (new Customer())->find($this->customer_id);
        $Customer->delete();
        return $this->success_response([__('messages.deleted_successfully')]);
    }
}
