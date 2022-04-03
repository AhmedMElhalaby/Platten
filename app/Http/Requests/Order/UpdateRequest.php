<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('customer')->check() || auth('vendor')->check();
    }
    public function rules():array
    {
        return [
            'order_id'=>'required|exists:orders,id',
            'status'=>'nullable|in:'.implode(',',array_values(Order::Statuses)),
        ];
    }
    public function attributes(): array
    {
        return [
            'order_id'=>__('models.Order.order_id'),
            'status'=>__('models.Order.status'),
        ];
    }
    public function run(): JsonResponse
    {
        $Order = (new Order())->find($this->order_id);
        switch ($this->status){
            case Order::Statuses['']:{

                break;
            }
        }
        return $this->success_response([__('messages.updated_successful')],[
            'Order'=>new OrderResource($Order)
        ]);
    }
}
