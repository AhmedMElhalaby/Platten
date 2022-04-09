<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Cart\DestroyRequest;
use App\Http\Requests\Customer\Cart\IndexRequest;
use App\Http\Requests\Customer\Cart\ShowRequest;
use App\Http\Requests\Customer\Cart\StoreRequest;
use App\Http\Requests\Customer\Cart\UpdateRequest;

class CartController extends Controller
{
    public function index(IndexRequest $request)
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
