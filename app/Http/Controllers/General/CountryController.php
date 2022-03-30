<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Country\DestroyRequest;
use App\Http\Requests\General\Country\IndexRequest;
use App\Http\Requests\General\Country\ShowRequest;
use App\Http\Requests\General\Country\StoreRequest;
use App\Http\Requests\General\Country\UpdateRequest;

class CountryController extends Controller
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
