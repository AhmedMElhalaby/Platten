<?php

namespace App\Http\Requests\Customer\Address;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'customer_id'=>'nullable|exists:customers,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'customer_id'=>__('models.Address.customer_id'),
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Addresses = new Address();
        if ($this->filled('vendor_id')) {
            $Addresses = $Addresses->where('customer_id',$this->customer_id);
        }
        if ($this->filled('q')) {
            $Addresses = $Addresses->where('name','Like','%'.$this->q.'%');
        }
        $Addresses = $Addresses->paginate($this->per_page??10);
        return $this->success_response([],['Addresses'=>AddressResource::collection($Addresses->items())],['Addresses'=>$Addresses]);
    }
}
