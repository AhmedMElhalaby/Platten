<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Bank\DestroyRequest;
use App\Http\Requests\General\Bank\IndexRequest;
use App\Http\Requests\General\Bank\ShowRequest;
use App\Http\Requests\General\Bank\StoreRequest;
use App\Http\Requests\General\Bank\UpdateRequest;

class BankController extends Controller
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
