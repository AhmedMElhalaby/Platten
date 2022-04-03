<?php

namespace App\Http\Requests\Customer\Address;

use App\Http\Requests\ApiRequest;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'address_id'=>'required|exists:addresses,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'address_id'=>__('models.Address.address_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Address = (new Address())->find($this->address_id);
        try{
            $Address->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
