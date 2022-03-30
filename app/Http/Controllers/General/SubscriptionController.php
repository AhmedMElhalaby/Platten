<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Subscription\DestroyRequest;
use App\Http\Requests\General\Subscription\IndexRequest;
use App\Http\Requests\General\Subscription\ShowRequest;
use App\Http\Requests\General\Subscription\StoreRequest;
use App\Http\Requests\General\Subscription\UpdateRequest;

class SubscriptionController extends Controller
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
