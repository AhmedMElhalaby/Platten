<?php

namespace App\Http\Requests\Customer\Address;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'address_id'=>'required|exists:addresses,id'
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
        return $this->success_response([],['Address'=>new AddressResource(Address::find($this->address_id))]);
    }
}
