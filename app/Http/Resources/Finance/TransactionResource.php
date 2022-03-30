<?php

namespace App\Http\Resources\Finance;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'amount'=>$this->amount,
            'account_type'=>$this->account_type,
            'account_id'=>$this->account_id,
            'status'=>$this->status,
            'type'=>$this->type,
            'ref_type'=>$this->ref_type,
            'ref_id'=>$this->ref_id,
            'payment_reference'=>$this->payment_reference,
        ];
    }
}
