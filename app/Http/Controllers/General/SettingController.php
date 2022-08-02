<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\General\Setting\IndexRequest;
use App\Http\Requests\General\Setting\ShowRequest;
use App\Http\Requests\General\Setting\UpdateRequest;

class SettingController extends Controller
{
    public function index(IndexRequest $request)
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
