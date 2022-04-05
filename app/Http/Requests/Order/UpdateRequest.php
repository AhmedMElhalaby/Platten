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
            'reject_reason'=>'required_if:status,'.Order::Statuses['Rejected'].'|string',
            'cancel_reason'=>'nullable|string'
        ];
    }
    public function attributes(): array
    {
        return [
            'order_id'=>__('models.Order.order_id'),
            'status'=>__('models.Order.status'),
            'reject_reason'=>__('models.Order.reject_reason'),
            'cancel_reason'=>__('models.Order.cancel_reason'),
        ];
    }
    public function run(): JsonResponse
    {
        $Order = (new Order())->find($this->order_id);
        switch ($this->status){
            case Order::Statuses['Accepted']:{
                $Order->status = Order::Statuses['Accepted'];
                $Order->save();
                break;
            }
            case Order::Statuses['Rejected']:{
                $Order->status = Order::Statuses['Rejected'];
                $Order->reject_reason = @$this->reject_reason;
                $Order->save();
                break;
            }
            case Order::Statuses['Canceled']:{
                $Order->status = Order::Statuses['Canceled'];
                $Order->cancel_reason = @$this->cancel_reason;
                $Order->save();
                break;
            }
            case Order::Statuses['Paid']:{
                $Order->status = Order::Statuses['Paid'];
                $Order->save();
                break;
            }
            case Order::Statuses['InProgress']:{
                $Order->status = Order::Statuses['InProgress'];
                $Order->save();
                break;
            }
            case Order::Statuses['Finished']:{
                $Order->status = Order::Statuses['Finished'];
                $Order->save();
                break;
            }
        }
        return $this->success_response([__('messages.updated_successful')],[
            'Order'=>new OrderResource($Order)
        ]);
    }
}
