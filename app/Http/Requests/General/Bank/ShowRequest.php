<?php

namespace App\Http\Requests\General\Bank;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BankResource;
use App\Models\Bank;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'bank_id'=>'required|exists:banks,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'bank_id'=>__('models.Bank.bank_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Bank'=>new BankResource(Bank::find($this->bank_id))
        ]);
    }
}
