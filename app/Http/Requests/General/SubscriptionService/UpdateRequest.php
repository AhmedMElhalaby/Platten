<?php

namespace App\Http\Requests\General\SubscriptionService;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionServiceResource;
use App\Models\SubscriptionService;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'subscription_service_id'=>'required|exists:subscriptions_services,id',
            'subscription_id'=>'nullable|exists:subscriptions,id',
            'name'=>'nullable|string|max:255',
            'color'=>'nullable|string|max:7|min:7',
            'checked'=>'nullable|boolean',
        ];
    }
    public function attributes(): array
    {
        return [
            'subscription_service_id'=>__('models.SubscriptionService.subscription_service_id'),
            'subscription_id'=>__('models.SubscriptionService.subscription_id'),
            'name'=>__('models.SubscriptionService.name'),
            'color'=>__('models.SubscriptionService.color'),
            'checked'=>__('models.SubscriptionService.checked'),
        ];
    }
    public function run(): JsonResponse
    {
        $SubscriptionService = (new SubscriptionService())->find($this->subscription_service_id);
        if ($this->filled('subscription_id')) {
            $SubscriptionService->subscription_id = $this->subscription_id;
        }
        if ($this->filled('name')) {
            $SubscriptionService->name = $this->name;
        }
        if ($this->filled('color')) {
            $SubscriptionService->color = $this->color;
        }
        if ($this->filled('checked')) {
            $SubscriptionService->checked = $this->checked;
        }
        $SubscriptionService->save();
        $SubscriptionService->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'SubscriptionService'=>new SubscriptionServiceResource($SubscriptionService)
        ]);
    }
}
