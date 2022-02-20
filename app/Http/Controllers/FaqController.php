<?php

namespace App\Http\Controllers;

use App\Http\Requests\Faq\DestroyRequest;
use App\Http\Requests\Faq\IndexRequest;
use App\Http\Requests\Faq\ShowRequest;
use App\Http\Requests\Faq\StoreRequest;
use App\Http\Requests\Faq\UpdateRequest;

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
