<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionService;
use App\Http\Requests\StoreSubscriptionServiceRequest;
use App\Http\Requests\UpdateSubscriptionServiceRequest;

class SubscriptionServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriptionServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionServiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionService  $subscriptionService
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionService $subscriptionService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionService  $subscriptionService
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionService $subscriptionService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionServiceRequest  $request
     * @param  \App\Models\SubscriptionService  $subscriptionService
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionServiceRequest $request, SubscriptionService $subscriptionService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionService  $subscriptionService
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionService $subscriptionService)
    {
        //
    }
}
