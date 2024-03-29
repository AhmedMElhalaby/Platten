<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Address\DestroyRequest;
use App\Http\Requests\Customer\Address\IndexRequest;
use App\Http\Requests\Customer\Address\MineRequest;
use App\Http\Requests\Customer\Address\ShowRequest;
use App\Http\Requests\Customer\Address\StoreRequest;
use App\Http\Requests\Customer\Address\UpdateRequest;

class AddressController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }
    public function mine(MineRequest $request)
    {
        return $request->run();
    }
    public function show(ShowRequest $request)
    {
        return $request->run();
    }
    public function store(StoreRequest $request)
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
