<?php

namespace App\Http\Requests\General\SubscriptionService;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionServiceResource;
use App\Models\SubscriptionService;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'subscription_id'=>'nullable|exists:subscriptions,id',
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
        $SubscriptionServices = (new SubscriptionService())->when($this->filled('subscription_id'),function ($q){
            return $q->where('subscription_id',$this->subscription_id);
        })->when($this->filled('q'),function($q){
            return $q->where('name','Like','%'.$this->q.'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'SubscriptionServices'=>SubscriptionServiceResource::collection($SubscriptionServices->items())
        ],[
            'SubscriptionServices'=>$SubscriptionServices
        ]);
    }
}
