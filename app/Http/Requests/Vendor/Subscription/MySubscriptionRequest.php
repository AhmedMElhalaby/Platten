<?php

namespace App\Http\Requests\Vendor\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubscriptionResource;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Models\VendorSubscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class MySubscriptionRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        $VendorSubscription = VendorSubscription::where('vendor_id',auth('vendor')->user()->id)->where('expire_at','>',Carbon::today())->firstOrFail();
        return $this->success_response([],['Subscription'=>new SubscriptionResource($VendorSubscription->subscription)]);
    }
}
