<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Subscription\MySubscriptionRequest;
use App\Http\Requests\Vendor\Subscription\PaySubscribeRequest;
use App\Http\Requests\Vendor\Subscription\SubscribeRequest;

class VendorSubscriptionController extends Controller
{
    public function my_subscription(MySubscriptionRequest $request)
    {
        return $request->run();
    }
    public function subscribe(SubscribeRequest $request)
    {
        return $request->run();
    }
    public function pay_subscribe(PaySubscribeRequest $request)
    {
        return $request->run();
    }
}
