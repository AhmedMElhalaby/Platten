<?php

namespace App\Http\Controllers;

use App\Http\Requests\Country\IndexRequest;
use App\Http\Requests\Country\ShowRequest;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use App\Http\Requests\Country\DestroyRequest;

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
