<?php

namespace App\Http\Requests\General\SubscriptionService;

use App\Http\Requests\ApiRequest;
use App\Models\SubscriptionService;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'subscription_service_id'=>'required|exists:subscriptions_services,id',
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
        $SubscriptionService = (new SubscriptionService())->find($this->subscription_service_id);
        try{
            $SubscriptionService->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
