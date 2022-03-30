<?php

namespace App\Http\Requests\General\Subscription;

use App\Http\Requests\ApiRequest;
use App\Models\Subscription;
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
            'subscription_id'=>'required|exists:subscriptions,id',
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
        $Subscription = (new Subscription())->find($this->subscription_id);
        try{
            $Subscription->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
