<?php

namespace App\Http\Requests\General\Bank;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BankResource;
use App\Models\Bank;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Bank.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Bank = new Bank();
        $Bank->name = $this->name;
        $Bank->save();
        $Bank->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'Bank'=>new BankResource($Bank)
        ]);
    }
}
