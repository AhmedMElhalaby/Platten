<?php

namespace App\Http\Requests\General\SubscriptionService;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionServiceResource;
use App\Models\SubscriptionService;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'subscription_service_id'=>'required|exists:subscriptions_services,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'subscription_service_id'=>__('models.SubscriptionService.subscription_service_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'SubscriptionService'=>new SubscriptionServiceResource(SubscriptionService::find($this->subscription_service_id))
        ]);
    }
}
