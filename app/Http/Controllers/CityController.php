<?php

namespace App\Http\Controllers;


use App\Http\Requests\City\DestroyRequest;
use App\Http\Requests\City\IndexRequest;
use App\Http\Requests\City\ShowRequest;
use App\Http\Requests\City\StoreRequest;
use App\Http\Requests\City\UpdateRequest;

class CityController extends Controller
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
