<?php

namespace App\Http\Requests\Finance\WithdrawalRequest;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Finance\WithdrawalRequestResource;
use App\Models\WithdrawalRequest;
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
            'per_page'=>'nullable|numeric',
            'status'=>'nullable|numeric|in:'.implode(',',array_values(WithdrawalRequest::Statuses)),
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
        if (auth('vendor')->check()){
            $account_id = auth('vendor')->user()->id;
            $account_type = WithdrawalRequest::AccountTypes['Vendor'];
        }
        if (auth('customer')->check()){
            $account_id = auth('customer')->user()->id;
            $account_type = WithdrawalRequest::AccountTypes['Customer'];
        }
        $WithdrawalRequests = (new WithdrawalRequest())
        ->when($this->filled('status'),function($q){
            return $q->where('status',$this->status);
        })
        ->when(isset($account_id)&&isset($account_type),function ($q) use ($account_id,$account_type){
            return $q->where('account_id',$account_id)->where('account_type',$account_type);
        })
        ->when(($this->filled('date_form') || $this->filled('date_to')),function($q){
            if ($this->filled('date_from') && $this->filled('date_to')){
                return $q->whereBetween('created_at',[$this->date_from,$this->date_to]);
            }elseif($this->filled('date_from') && !$this->filled('date_to')){
                return $q->where('created_at','>',$this->date_from);
            }else{
                return $q->where('created_at','<',$this->date_to);
            }
        })
        ->paginate($this->per_page??10);
        return $this->success_response([],[
            'WithdrawalRequests'=>WithdrawalRequestResource::collection($WithdrawalRequests->items())
        ],[
            'WithdrawalRequests'=>$WithdrawalRequests
        ]);
    }
}
