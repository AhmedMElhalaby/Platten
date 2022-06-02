<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Product\DestroyRequest;
use App\Http\Requests\Vendor\Product\IndexRequest;
use App\Http\Requests\Vendor\Product\ReviewRequest;
use App\Http\Requests\Vendor\Product\ShowRequest;
use App\Http\Requests\Vendor\Product\StoreRequest;
use App\Http\Requests\Vendor\Product\UpdateRequest;

class ProductController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }
    public function show(ShowRequest $request)
    {
        return $request->run();
    }
    public function reviews(ReviewRequest $request)
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
