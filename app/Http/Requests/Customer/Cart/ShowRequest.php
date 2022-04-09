<?php

namespace App\Http\Requests\Customer\Cart;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'cart_id'=>'required|exists:carts,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'cart_id'=>__('models.Cart.cart_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],['Cart'=>new CartResource(Cart::find($this->cart_id))]);
    }
}
