<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Http\Requests\Order\ShowRequest;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;

class OrderController extends Controller
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
}
