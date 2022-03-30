<?php

namespace App\Http\Controllers\General;


use App\Http\Controllers\Controller;
use App\Http\Requests\General\City\DestroyRequest;
use App\Http\Requests\General\City\IndexRequest;
use App\Http\Requests\General\City\ShowRequest;
use App\Http\Requests\General\City\StoreRequest;
use App\Http\Requests\General\City\UpdateRequest;

class CityController extends Controller
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
