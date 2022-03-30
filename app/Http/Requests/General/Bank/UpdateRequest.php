<?php

namespace App\Http\Requests\General\Bank;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BankResource;
use App\Models\Bank;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'bank_id'=>'required|exists:banks,id',
            'name'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'bank_id'=>__('models.Bank.bank_id'),
            'name'=>__('models.Bank.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Bank = (new Bank())->find($this->bank_id);
        if ($this->filled('name')) {
            $Bank->name = $this->name;
        }
        $Bank->save();
        $Bank->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'Bank'=>new BankResource($Bank)
        ]);
    }
}
