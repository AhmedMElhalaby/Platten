<?php

namespace App\Http\Requests\Customer\Address;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\AddressResource;
use App\Models\Address;
use Illuminate\Http\JsonResponse;

class MineRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('customer')->check();
    }

    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Addresses = new Address();
        $Addresses = $Addresses->where('customer_id',auth('customer')->user()->id);
        if ($this->filled('q')) {
            $Addresses = $Addresses->where('name','Like','%'.$this->q.'%');
        }
        $Addresses = $Addresses->paginate($this->per_page??10);
        return $this->success_response([],['Addresses'=>AddressResource::collection($Addresses->items())],['Addresses'=>$Addresses]);
    }
}
