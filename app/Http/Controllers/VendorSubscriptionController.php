<?php

namespace App\Http\Controllers;

use App\Models\VendorSubscription;
use App\Http\Requests\StoreVendorSubscriptionRequest;
use App\Http\Requests\UpdateVendorSubscriptionRequest;

class VendorSubscriptionController extends Controller
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
     * @param  \App\Http\Requests\StoreVendorSubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorSubscriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorSubscription  $vendorSubscription
     * @return \Illuminate\Http\Response
     */
    public function show(VendorSubscription $vendorSubscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorSubscription  $vendorSubscription
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorSubscription $vendorSubscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorSubscriptionRequest  $request
     * @param  \App\Models\VendorSubscription  $vendorSubscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorSubscriptionRequest $request, VendorSubscription $vendorSubscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorSubscription  $vendorSubscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorSubscription $vendorSubscription)
    {
        //
    }
}
