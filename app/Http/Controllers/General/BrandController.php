<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Brand\DestroyRequest;
use App\Http\Requests\General\Brand\IndexRequest;
use App\Http\Requests\General\Brand\ShowRequest;
use App\Http\Requests\General\Brand\StoreRequest;
use App\Http\Requests\General\Brand\UpdateRequest;

class BrandController extends Controller
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
