<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use function __;
use function auth;

class UpdatePasswordRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'old_password'=>'required|string|min:6|max:255',
            'password'=>'required|confirmed|string|min:6|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'old_password'=>__('models.Customer.old_password'),
            'password'=>__('models.Customer.password'),
            'password_confirmation'=>__('models.Customer.password_confirmation'),
        ];
    }
    public function run(): JsonResponse
    {
        $Customer = (new Customer())->find(auth('customer')->user()->id);
        if(Hash::check($this->old_password,$Customer->password)){
            $Customer->password = Hash::make($this->password);
            $Customer->save();
            $Customer->refresh();
            return $this->success_response([__('messages.updated_successful')],['Customer'=>new CustomerResource($Customer)]);
        }
        return $this->fail_response([__('auth.password_not_correct')]);
    }
}
