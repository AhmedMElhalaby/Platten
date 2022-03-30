<?php

namespace App\Http\Resources\Finance;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalRequestResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'reject_reason'=>$this->reject_reason,
            'amount'=>$this->amount,
            'bank_id'=>$this->bank_id,
            'iban'=>$this->iban,
            'account_type'=>$this->account_type,
            'account_id'=>$this->account_id,
            'status'=>$this->status,
        ];
    }
}
