<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'order_id'=>'required|exists:orders,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'order_id'=>__('models.Order.order_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Order'=>new OrderResource(Order::find($this->order_id))
        ]);
    }
}
