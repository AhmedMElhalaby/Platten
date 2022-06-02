<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check();
    }
    public function rules():array
    {
        return [
            'order_id'=>'required|exists:orders,id',
            'product_id'=>'required|exists:products,id',
            'rate'=>'required|numeric|min:1|max:5',
            'review'=>'nullable|string'
        ];
    }
    public function attributes(): array
    {
        return [
            'order_id'=>__('models.Review.order_id'),
            'product_id'=>__('models.Review.product_id'),
            'rate'=>__('models.Review.rate'),
            'review'=>__('models.Review.review'),
        ];
    }
    public function run(): JsonResponse
    {
        $Review = (new Review())->where('order_id',$this->order_id)->where('product_id',$this->product_id)->where('customer_id',auth('customer')->user()->id)->first();
        if (!$Review){
            $Review = new Review();
            $Review->customer_id = auth('customer')->user()->id;
        }
        $Review->order_id = $this->order_id;
        $Review->product_id = $this->product_id;
        $Review->rate = $this->rate;
        $Review->review = $this->review;
        $Review->save();
        return $this->success_response([__('messages.updated_successful')]);
    }
}
