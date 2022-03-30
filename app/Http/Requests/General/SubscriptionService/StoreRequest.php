<?php

namespace App\Http\Requests\General\SubscriptionService;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionServiceResource;
use App\Models\SubscriptionService;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'subscription_id'=>'required|exists:subscriptions,id',
            'name'=>'required|string|max:255',
            'color'=>'required|string|max:7|min:7',
            'checked'=>'required|boolean',
        ];
    }
    public function attributes(): array
    {
        return [
            'subscription_id'=>__('models.SubscriptionService.subscription_id'),
            'name'=>__('models.SubscriptionService.name'),
            'color'=>__('models.SubscriptionService.color'),
            'checked'=>__('models.SubscriptionService.checked'),
        ];
    }
    public function run(): JsonResponse
    {
        $SubscriptionService = new SubscriptionService();
        $SubscriptionService->subscription_id = $this->subscription_id;
        $SubscriptionService->name = $this->name;
        $SubscriptionService->color = $this->color;
        $SubscriptionService->checked = $this->checked;
        $SubscriptionService->save();
        $SubscriptionService->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'SubscriptionService'=>new SubscriptionServiceResource($SubscriptionService)
        ]);
    }
}
