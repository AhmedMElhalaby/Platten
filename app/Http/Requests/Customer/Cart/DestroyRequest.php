<?php

namespace App\Http\Requests\Customer\Cart;

use App\Http\Requests\ApiRequest;
use App\Models\Cart;
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
            'cart_id'=>'required|exists:carts,id',
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
        $Cart = (new Cart())->find($this->cart_id);
        try{
            $Cart->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
