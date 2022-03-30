<?php

namespace App\Http\Requests\General\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
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
        $Subscriptions = (new Subscription())->when($this->filled('q'),function($q){
            return $q->where('name','Like','%'.$this->q.'%')->orWhere('description','Like','%'.$this->q.'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'Subscriptions'=>SubscriptionResource::collection($Subscriptions->items())
        ],[
            'Subscriptions'=>$Subscriptions
        ]);
    }
}
