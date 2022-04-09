<?php

namespace App\Http\Requests\Vendor\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\VendorSubscriptionResource;
use App\Models\Subscription;
use App\Models\VendorSubscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class PaySubscribeRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'vendor_subscription_id'=>'required|exists:vendors_subscriptions,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'vendor_subscription_id'=>__('models.VendorSubscription.vendor_subscription_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $VendorSubscription = VendorSubscription::find($this->vendor_subscription_id);
        $VendorSubscription->paid = true;
        $VendorSubscription->save();
        return $this->success_response([],['VendorSubscription'=>new VendorSubscriptionResource($VendorSubscription)]);
    }
}
