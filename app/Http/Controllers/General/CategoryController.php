<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Category\DestroyRequest;
use App\Http\Requests\General\Category\IndexRequest;
use App\Http\Requests\General\Category\ShowRequest;
use App\Http\Requests\General\Category\StoreRequest;
use App\Http\Requests\General\Category\UpdateRequest;

class CategoryController extends Controller
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
