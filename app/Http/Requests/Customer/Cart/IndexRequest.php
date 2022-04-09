<?php

namespace App\Http\Requests\Customer\Cart;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
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
        $Carts = new Cart();
        $Carts = $Carts->where('customer_id',auth('customer')->user()->id);
        if ($this->filled('q')) {
            $Carts = $Carts->where('name','Like','%'.$this->q.'%');
        }
        $Carts = $Carts->paginate($this->per_page??10);
        return $this->success_response([],['Carts'=>CartResource::collection($Carts->items())],['Carts'=>$Carts]);
    }
}
