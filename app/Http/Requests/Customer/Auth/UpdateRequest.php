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
        return auth('customer')->check() || auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'nullable|string|max:255',
            'email'=>'nullable|string|email|unique:customers,email|max:255',
            'mobile'=>'nullable|string',
            'avatar'=>'nullable|mimes:png,jpg,jpeg',
            'is_active'=>'nullable|boolean',
        ];
    }
    public function attributes(): array
    {
        return [
            'customer_id'=>__('models.Customer.customer_id'),
            'name'=>__('models.Customer.name'),
            'email'=>__('models.Customer.email'),
            'mobile'=>__('models.Customer.mobile'),
            'avatar'=>__('models.Customer.avatar'),
        ];
    }
    public function run(): JsonResponse
    {
        if ($this->filled('customer_id')){
            $Customer = (new Customer())->find($this->customer_id);
        }else{
            $Customer = (new Customer())->find(auth('customer')->user()->id);
        }
        if ($this->filled('name')) {
            $Customer->name = $this->name;
        }
        if ($this->filled('email')) {
            $Customer->email = $this->email;
        }
        if ($this->filled('mobile')){
            $Customer->mobile = $this->mobile;
        }
        if ($this->filled('is_active')){
            $Customer->is_active = $this->is_active;
        }
        if ($this->hasFile('avatar')){
            $media = $this->file('avatar');
            $path = $media->store('public/files');
            $Customer->avatar = $path;
        }
        $Customer->save();
        $Customer->refresh();
        return $this->success_response([__('messages.updated_successful')],['Customer'=>new CustomerResource($Customer)]);
    }
}
