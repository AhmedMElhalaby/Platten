<?php

namespace App\Http\Requests\Finance\WithdrawalRequest;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\WithdrawalRequestResource;
use App\Models\WithdrawalRequest;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check() || auth('vendor')->check() || auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'withdrawal_request_id'=>'required|exists:withdrawal_requests,id',
            'status'=>'required|numeric|in:'.implode(',',array_values(WithdrawalRequest::Statuses)),
            'reject_reason'=>'required_if:status,'.WithdrawalRequest::Statuses['Rejected'].'|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'withdrawal_request_id'=>__('models.WithdrawalRequest.withdrawal_request_id'),
            'status'=>__('models.WithdrawalRequest.status'),
            'reject_reason'=>__('models.WithdrawalRequest.reject_reason'),
        ];
    }
    public function run(): JsonResponse
    {
        $WithdrawalRequest = (new WithdrawalRequest())->find($this->withdrawal_request_id);
        switch ($this->status){
            case WithdrawalRequest::Statuses['Accepted']:{
                $WithdrawalRequest->status = WithdrawalRequest::Statuses['Accepted'];
                break;
            }
            case WithdrawalRequest::Statuses['Rejected']:{
                $WithdrawalRequest->status = WithdrawalRequest::Statuses['Rejected'];
                $WithdrawalRequest->reject_reason = $this->reject_reason;
                break;
            }
            case WithdrawalRequest::Statuses['Canceled']:{
                $WithdrawalRequest->status = WithdrawalRequest::Statuses['Canceled'];
                break;
            }
        }
        $WithdrawalRequest->save();
        $WithdrawalRequest->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'WithdrawalRequest'=>new WithdrawalRequestResource($WithdrawalRequest)
        ]);
    }
}
