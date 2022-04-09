<?php

namespace App\Http\Requests\Vendor\Subscription;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\VendorSubscriptionResource;
use App\Models\VendorSubscription;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class MySubscriptionRequest extends ApiRequest
{
    public function run(): JsonResponse
    {
        $VendorSubscription = VendorSubscription::where('vendor_id',auth('vendor')->user()->id)->where('expire_at','>',Carbon::today())->first();
        if (!$VendorSubscription){
            return $this->fail_response([__('messages.object_not_found')]);
        }
        return $this->success_response([],['VendorSubscription'=>new VendorSubscriptionResource($VendorSubscription)]);
    }
}
