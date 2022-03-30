<?php

namespace App\Http\Controllers\General\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Product\ProductTypeModel\DestroyRequest;
use App\Http\Requests\General\Product\ProductTypeModel\IndexRequest;
use App\Http\Requests\General\Product\ProductTypeModel\ShowRequest;
use App\Http\Requests\General\Product\ProductTypeModel\StoreRequest;
use App\Http\Requests\General\Product\ProductTypeModel\UpdateRequest;

class ProductTypeModelController extends Controller
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
