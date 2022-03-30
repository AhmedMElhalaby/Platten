<?php

namespace App\Http\Requests\Finance\WithdrawalRequest;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\WithdrawalRequestResource;
use App\Models\WithdrawalRequest;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('vendor')->check() || auth('customer')->check() || auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'withdrawal_request_id'=>'required|exists:withdrawal_requests,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'withdrawal_request_id'=>__('models.WithdrawalRequest.withdrawal_request_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'WithdrawalRequest'=>new WithdrawalRequestResource(WithdrawalRequest::find($this->withdrawal_request_id))
        ]);
    }
}
