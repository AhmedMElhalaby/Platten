<?php

namespace App\Http\Requests\Finance\Transaction;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\TransactionResource;
use App\Models\Transaction;
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
            'transaction_id'=>'required|exists:transactions,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'transaction_id'=>__('models.Transaction.transaction_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Transaction'=>new TransactionResource(Transaction::find($this->transaction_id))
        ]);
    }
}
