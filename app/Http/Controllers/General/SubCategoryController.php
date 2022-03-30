<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\SubCategory\DestroyRequest;
use App\Http\Requests\General\SubCategory\IndexRequest;
use App\Http\Requests\General\SubCategory\ShowRequest;
use App\Http\Requests\General\SubCategory\StoreRequest;
use App\Http\Requests\General\SubCategory\UpdateRequest;

class SubCategoryController extends Controller
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
