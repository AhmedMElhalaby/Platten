<?php

namespace App\Http\Requests\Finance\Transaction;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('vendor')->check() || auth('customer')->check() || auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'account_id'=>'required_with:account_type|exists:accounts,id',
            'account_type'=>'required_with:account_id|in:'.implode(',',array_values(Transaction::AccountTypes)),
            'per_page'=>'nullable|numeric',
            'status'=>'nullable|numeric|in:'.implode(',',array_values(Transaction::Statuses)),
            'date_from'=>'nullable|date',
            'date_to'=>'nullable|date',
        ];
    }
    public function attributes(): array
    {
        return [
            'status'=>__('models.q'),
            'date_from'=>__('models.date_from'),
            'date_to'=>__('models.date_to'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $data = $this->all();

        if ($this->filled('account_id') && $this->filled('account_type')){
            $account_id = $this->account_id;
            $account_type = $this->account_type;
        }else{
            if (auth('vendor')->check()){
                $account_id = auth('vendor')->user()->id;
                $account_type = Transaction::AccountTypes['Vendor'];
            }
            if (auth('customer')->check()){
                $account_id = auth('customer')->user()->id;
                $account_type = Transaction::AccountTypes['Customer'];
            }
        }

        $Transactions = (new Transaction())
        ->when($this->filled('status'),function($q){
            return $q->where('status',$this->status);
        })
        ->when(isset($account_id)&&isset($account_type),function ($q) use ($account_id,$account_type){
            return $q->where('account_id',$account_id)->where('account_type',$account_type);
        })
        ->when(($this->filled('date_form') || $this->filled('date_to')),function($q) use($data){
            if (isset($data['date_from']) && isset($data['date_to'])){
                return $q->whereBetween('created_at',[$data['date_from'],$data['date_to']]);
            }elseif(isset($data['date_from']) && !isset($data['date_to'])){
                return $q->where('created_at','>',$data['date_from']);
            }else{
                return $q->where('created_at','<',$data['date_to']);
            }
        })
        ->paginate($this->per_page??10);
        return $this->success_response([],[
            'Transactions'=>TransactionResource::collection($Transactions->items())
        ],[
            'Transactions'=>$Transactions
        ]);
    }
}
