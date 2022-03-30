<?php

namespace App\Http\Requests\Vendor\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionResource;
use App\Http\Resources\VendorResource;
use App\Models\Subscription;
use App\Models\Vendor;
use App\Models\VendorSubscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class SubscribeRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'subscription_id'=>'required|exists:subscriptions,id',
            'billing_type'=>'required|in:'.implode(',',array_values(VendorSubscription::BillingTypes)),
        ];
    }
    public function attributes(): array
    {
        return [
            'subscription_id'=>__('models.VendorSubscription.subscription_id'),
            'billing_type'=>__('models.VendorSubscription.billing_type'),
        ];
    }
    public function run(): JsonResponse
    {
        $VendorSubscription = VendorSubscription::where('vendor_id',auth('vendor')->user()->id)->where('expire_at','>',Carbon::today())->firstOrFail();
        if (!$VendorSubscription){
            $Subscription = Subscription::find($this->subscription_id);
            $VendorSubscription = new VendorSubscription();
            $VendorSubscription->vendor_id = auth('vendor')->user()->id;
            $VendorSubscription->vendor_id = $this->subscription_id;
            $VendorSubscription->billing_type = $this->billing_type;
            $VendorSubscription->price = ($this->billing_type == VendorSubscription::BillingTypes['Monthly'])?$Subscription->monthly_price : $Subscription->yearly_price;
            $VendorSubscription->start_at = Carbon::today();
            $VendorSubscription->expire_at = Carbon::today()->addMonths(($this->billing_type == VendorSubscription::BillingTypes['Monthly'])?1 : 12);
            $VendorSubscription->save();
        }
        return $this->success_response([],['Subscription'=>new SubscriptionResource($VendorSubscription->subscription)]);
    }
}
