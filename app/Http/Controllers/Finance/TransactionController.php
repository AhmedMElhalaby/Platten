<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\Transaction\IndexRequest;
use App\Http\Requests\Finance\Transaction\ShowRequest;
use App\Http\Requests\Finance\Transaction\StoreRequest;
use App\Http\Requests\Finance\Transaction\UpdateRequest;

class TransactionController extends Controller
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
}
