<?php

namespace App\Http\Requests\Vendor;

use App\Http\Requests\ApiRequest;
use Illuminate\Http\JsonResponse;

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
