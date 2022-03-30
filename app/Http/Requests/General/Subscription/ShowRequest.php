<?php

namespace App\Http\Requests\General\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'subscription_id'=>'required|exists:subscriptions,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'subscription_id'=>__('models.Subscription.subscription_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Subscription'=>new SubscriptionResource(Subscription::find($this->subscription_id))
        ]);
    }
}
