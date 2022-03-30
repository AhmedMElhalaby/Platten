<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Faq\DestroyRequest;
use App\Http\Requests\General\Faq\IndexRequest;
use App\Http\Requests\General\Faq\ShowRequest;
use App\Http\Requests\General\Faq\StoreRequest;
use App\Http\Requests\General\Faq\UpdateRequest;

class FaqController extends Controller
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
