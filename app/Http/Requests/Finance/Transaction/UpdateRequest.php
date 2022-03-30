<?php

namespace App\Http\Requests\Finance\Transaction;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('vendor')->check() || auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'transaction_id'=>'required|exists:transactions,id',
            'status'=>'required|numeric|in:'.implode(',',array_values(Transaction::Statuses)),
        ];
    }
    public function attributes(): array
    {
        return [
            'transaction_id'=>__('models.Transaction.transaction_id'),
            'status'=>__('models.Transaction.status'),
        ];
    }
    public function run(): JsonResponse
    {
        $Transaction = (new Transaction())->find($this->transaction_id);
        switch ($this->status){
            case Transaction::Statuses['InHold']:{
                $Transaction->status = Transaction::Statuses['InHold'];
                break;
            }
            case Transaction::Statuses['Placed']:{
                $Transaction->status = Transaction::Statuses['Placed'];
                break;
            }
            case Transaction::Statuses['Failed']:{
                $Transaction->status = Transaction::Statuses['Failed'];
                break;
            }
        }
        $Transaction->save();
        $Transaction->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'Transaction'=>new TransactionResource($Transaction)
        ]);
    }
}
