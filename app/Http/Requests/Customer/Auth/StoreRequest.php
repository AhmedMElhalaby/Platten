<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;
use function auth;

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
            'mobile'=>'nullable|string',
            'avatar'=>'nullable|mimes:png,jpg,jpeg',
            'password'=>'required|string|min:8|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Customer.name'),
            'email'=>__('models.Customer.email'),
            'mobile'=>__('models.Customer.mobile'),
            'avatar'=>__('models.Customer.avatar'),
            'password'=>__('models.Customer.password'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = new Customer();
        $Customer->name = $this->name;
        $Customer->email = $this->email;
        if ($this->filled('mobile')){
            $Customer->mobile = $this->mobile;
        }
        if ($this->hasFile('avatar')){
            $media = $this->file('avatar');
            $path = $media->store('public/files');
            $Customer->avatar = $path;
        }
        $Customer->password = Hash::make($this->password);
        $Customer->save();
        $Customer->refresh();
        return $this->success_response([__('messages.created_successful')],['Customer'=>new CustomerResource($Customer)]);
    }
}
