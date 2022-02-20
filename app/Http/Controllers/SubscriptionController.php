<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscription\DestroyRequest;
use App\Http\Requests\Subscription\IndexRequest;
use App\Http\Requests\Subscription\ShowRequest;
use App\Http\Requests\Subscription\StoreRequest;
use App\Http\Requests\Subscription\UpdateRequest;

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
