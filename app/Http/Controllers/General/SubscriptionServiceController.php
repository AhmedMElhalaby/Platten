<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\SubscriptionService\DestroyRequest;
use App\Http\Requests\General\SubscriptionService\IndexRequest;
use App\Http\Requests\General\SubscriptionService\ShowRequest;
use App\Http\Requests\General\SubscriptionService\StoreRequest;
use App\Http\Requests\General\SubscriptionService\UpdateRequest;

class SubscriptionServiceController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }
    public function store(StoreRequest $request)
    {
        return $request->run();
    }
    public function show(ShowRequest $request)
    {
        return $request->run();
    }
    public function update(UpdateRequest $request)
    {
        return $request->run();
    }
    public function destroy(DestroyRequest $request)
    {
        return $request->run();
    }
}
