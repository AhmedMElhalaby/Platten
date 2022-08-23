<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Advertisement\DestroyRequest;
use App\Http\Requests\General\Advertisement\IndexRequest;
use App\Http\Requests\General\Advertisement\ShowRequest;
use App\Http\Requests\General\Advertisement\StoreRequest;
use App\Http\Requests\General\Advertisement\UpdateRequest;

class AdvertisementController extends Controller
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
