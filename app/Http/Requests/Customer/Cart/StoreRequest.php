<?php

namespace App\Http\Requests\Customer\Cart;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Customer\CartResource;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'product_id'=>'required|exists:products,id',
            'quantity'=>'required|numeric',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_id'=>__('models.Cart.product_id'),
            'quantity'=>__('models.Cart.quantity'),
        ];
    }
    public function run(): JsonResponse
    {
        $Cart = new Cart();
        $Cart->customer_id = auth('customer')->user()->id;
        $Cart->product_id = $this->product_id;
        $Cart->quantity = $this->quantity;
        $Cart->save();
        $Cart->refresh();
        return $this->success_response([__('messages.created_successful')],['Cart'=>new CartResource($Cart)]);
    }
}
