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
        return auth('employee')->check();
    }
    public function run(): JsonResponse
    {
        $this->user('employee')->token()->revoke();
        $this->user('employee')->token()->delete();
        return $this->success_response([__('auth.logout')]);
    }
}
