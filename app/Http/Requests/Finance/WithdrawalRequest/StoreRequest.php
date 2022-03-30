<?php

namespace App\Http\Requests\Finance\WithdrawalRequest;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\WithdrawalRequestResource;
use App\Models\WithdrawalRequest;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('vendor')->check() || auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'amount'=>'required|numeric',
            'bank_id'=>'required|exists:banks,id',
            'iban'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'amount'=>__('models.WithdrawalRequest.amount'),
            'bank_id'=>__('models.WithdrawalRequest.bank_id'),
            'iban'=>__('models.WithdrawalRequest.iban'),
        ];
    }
    public function run(): JsonResponse
    {
        $WithdrawalRequest = new WithdrawalRequest();
        if (auth('vendor')->check()){
            $WithdrawalRequest->account_id = auth('vendor')->user()->id;
            $WithdrawalRequest->account_type = WithdrawalRequest::AccountTypes['Vendor'];
        }
        if (auth('customer')->check()){
            $WithdrawalRequest->account_id = auth('customer')->user()->id;
            $WithdrawalRequest->account_type = WithdrawalRequest::AccountTypes['Customer'];
        }
        $WithdrawalRequest->amount = $this->amount;
        $WithdrawalRequest->bank_id = $this->bank_id;
        $WithdrawalRequest->iban = $this->iban;
        $WithdrawalRequest->save();
        $WithdrawalRequest->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'WithdrawalRequest'=>new WithdrawalRequestResource($WithdrawalRequest)
        ]);
    }
}
