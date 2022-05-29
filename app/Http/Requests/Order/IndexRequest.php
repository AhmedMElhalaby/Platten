<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'customer_id'=>'nullable|exists:customers,id',
            'vendor_id'=>'nullable|exists:vendors,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $data = $this->all();
        $Orders = (new Order())->when($this->filled('customer_id'),function($q) use($data){
            return $q->where('customer_id',$data['customer_id']);
        })->when($this->filled('vendor_id'),function($q) use($data){
            return $q->where('vendor_id',$data['vendor_id']);
        })->when($this->filled('status'),function($q) use($data){
            return $q->where('status',$data['status']);
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'Orders'=>OrderResource::collection($Orders->items())
        ],[
            'Orders'=>$Orders
        ]);
    }
}
