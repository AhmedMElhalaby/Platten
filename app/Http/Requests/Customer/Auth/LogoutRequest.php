<?php

namespace App\Http\Requests\Customer\Auth;

use App\Http\Requests\ApiRequest;
use Illuminate\Http\JsonResponse;
use function __;
use function auth;

class LogoutRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('customer')->check();
    }
    public function run(): JsonResponse
    {
        $this->user('customer')->token()->revoke();
        $this->user('customer')->token()->delete();
        return $this->success_response([__('auth.logout')]);
    }
}
