<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Subscription\MySubscriptionRequest;

class VendorSubscriptionController extends Controller
{
    public function my_subscription(MySubscriptionRequest $request)
    {
        return $request->run();
    }
    public function subscribe()
    {

    }
}
