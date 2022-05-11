<?php

namespace App\Http\Requests\Vendor\Auth;

use App\Http\Requests\ApiRequest;
use Illuminate\Http\JsonResponse;
use function __;
use function auth;

class LogoutRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('vendor')->check();
    }
    public function run(): JsonResponse
    {
        $this->user('vendor')->token()->revoke();
        $this->user('vendor')->token()->delete();
        return $this->success_response([__('auth.logout')]);
    }
}
