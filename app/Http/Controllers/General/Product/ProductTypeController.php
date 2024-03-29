<?php

namespace App\Http\Controllers\General\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Product\ProductType\DeleteMediaRequest;
use App\Http\Requests\General\Product\ProductType\DestroyRequest;
use App\Http\Requests\General\Product\ProductType\IndexRequest;
use App\Http\Requests\General\Product\ProductType\ShowRequest;
use App\Http\Requests\General\Product\ProductType\StoreRequest;
use App\Http\Requests\General\Product\ProductType\UpdateRequest;

class ProductTypeController extends Controller
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
    public function delete_media(DeleteMediaRequest $request)
    {
        return $request->run();
    }
}
