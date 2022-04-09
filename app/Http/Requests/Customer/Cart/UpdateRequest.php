<?php

namespace App\Http\Requests\Customer\Cart;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'cart_id'=>'required|exists:carts,id',
            'product_id'=>'nullable|exists:products,id',
            'quantity'=>'nullable|numeric',
        ];
    }
    public function attributes(): array
    {
        return [
            'cart_id'=>__('models.Cart.cart_id'),
            'product_id'=>__('models.Cart.product_id'),
            'quantity'=>__('models.Cart.quantity'),
        ];
    }
    public function run(): JsonResponse
    {
        $Cart = (new Cart())->find($this->cart_id);
        if ($this->filled('product_id')) {
            $Cart->product_id = $this->product_id;
        }
        if ($this->filled('quantity')) {
            $Cart->quantity = $this->quantity;
        }
        $Cart->save();
        $Cart->refresh();
        return $this->success_response([__('messages.updated_successful')],['Cart'=>new CartResource($Cart)]);
    }
}
