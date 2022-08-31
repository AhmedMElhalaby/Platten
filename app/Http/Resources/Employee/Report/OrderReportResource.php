<?php

namespace App\Http\Resources\Employee\Report;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderReportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'customer_name'=>$this->customer->name,
            'vendor_name'=>$this->vendor->name,
            'have_discount'=> (bool)$this->discount_id,
            'discount_amount'=>$this->discount_amount,
            'cost'=>$this->cost,
            'amount'=>$this->amount,
            'total_amount'=>$this->total_amount,
            'recipient_name'=>$this->recipient_name,
            'mobile'=>$this->mobile,
            'address'=>$this->address,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'map_address'=>$this->map_address,
            'status'=>Order::StatusesStr[$this->status],
            'created_at'=>Carbon::parse($this->created_at)->format('d M, Y H:i A')
        ];
    }
}
