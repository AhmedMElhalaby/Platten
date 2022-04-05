<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
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
            'discount_id'=>'nullable|exists:discounts,id',
            'address_id'=>'required|exists:addresses,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'discount_id'=>__('models.Order.discount_id'),
            'address_id'=>__('models.Order.address_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Carts = Cart::where('customer_id',auth('customer')->user()->id)->get();
        if (count($Carts)==0){
            return $this->fail_response([__('cart is empty')]);
        }
        $vendor_id = null;
        $cost = 0;
        $total_amount = 0;
        $discount_amount = 0;
        $Address = Address::find($this->address_id);
        $Order = new Order();
        $Order->customer_id = auth('customer')->user()->id;
        $Order->recipient_name = $Address->recipient_name;
        $Order->mobile = $Address->mobile;
        $Order->address = $Address->address;
        $Order->lat = $Address->lat;
        $Order->lng = $Address->lng;
        $Order->map_address = $Address->map_address;
        $Order->save();
        $Order->refresh();
        foreach ($Carts as $cart){
            $Product = Product::find($cart->product_id);
            $OrderProduct = new OrderProduct();
            $OrderProduct->order_id = $Order->id;
            $OrderProduct->product_id = $cart->product_id;
            $OrderProduct->quantity = $cart->quantity;
            $OrderProduct->amount = $Product->sell_price;
            $OrderProduct->total = $Product->sell_price * $cart->quantity;
            $OrderProduct->save();
            $cart->delete();
            $vendor_id = $Product->vendor_id;
            $total_amount += $Product->sell_price * $cart->quantity;
            $cost += $Product->cost_price * $cart->quantity;
        }
        if ($this->filled('discount_id')){
            $Discount = Discount::find($this->discount_id);
            $discount_amount = $total_amount * ($Discount->rate/100);
        }
        $Order->vendor_id = $vendor_id;
        $Order->cost = $cost;
        $Order->amount = $total_amount;
        $Order->discount_amount = $discount_amount;
        $Order->total_amount = $total_amount - $discount_amount;
        $Order->save();
        return $this->success_response([__('messages.created_successful')],[
            'Order'=>new OrderResource($Order)
        ]);
    }
}
