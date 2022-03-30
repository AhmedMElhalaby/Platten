<?php

namespace App\Http\Requests\General\Bank;

use App\Http\Requests\ApiRequest;
use App\Models\Bank;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'bank_id'=>'required|exists:banks,id',
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
        $Bank = (new Bank())->find($this->bank_id);
        try {
            $Bank->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
