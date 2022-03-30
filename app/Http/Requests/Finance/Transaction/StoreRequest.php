<?php

namespace App\Http\Requests\Finance\Transaction;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\TransactionResource;
use App\Models\Transaction;
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
        ];
    }
    public function attributes(): array
    {
        return [
            'amount'=>__('models.Transaction.amount'),
        ];
    }
    public function run(): JsonResponse
    {
        $Transaction = new Transaction();
        if (auth('vendor')->check()){
            $Transaction->account_id = auth('vendor')->user()->id;
            $Transaction->account_type = Transaction::AccountTypes['Vendor'];
        }
        if (auth('customer')->check()){
            $Transaction->account_id = auth('customer')->user()->id;
            $Transaction->account_type = Transaction::AccountTypes['Customer'];
        }
        $Transaction->amount = $this->amount;
        $Transaction->type = Transaction::Types['Deposit'];
        $Transaction->save();
        $Transaction->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'Transaction'=>new TransactionResource($Transaction)
        ]);
    }
}
