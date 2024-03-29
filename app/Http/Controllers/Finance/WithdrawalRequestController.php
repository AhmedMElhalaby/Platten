<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Finance\WithdrawalRequest\IndexRequest;
use App\Http\Requests\Finance\WithdrawalRequest\ShowRequest;
use App\Http\Requests\Finance\WithdrawalRequest\StoreRequest;
use App\Http\Requests\Finance\WithdrawalRequest\UpdateRequest;

class WithdrawalRequestController extends Controller
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
}
