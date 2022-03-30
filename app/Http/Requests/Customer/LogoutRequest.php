<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\ApiRequest;
use Illuminate\Http\JsonResponse;

class LogoutRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function run(): JsonResponse
    {
        $this->user('employee')->token()->revoke();
        $this->user('employee')->token()->delete();
        return $this->success_response([__('auth.logout')]);
    }
}
