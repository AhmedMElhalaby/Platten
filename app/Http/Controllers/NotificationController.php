<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\IndexRequest;
use App\Http\Requests\Notification\ReadRequest;
use App\Http\Requests\Notification\SendRequest;
use App\Http\Requests\Notification\ShowRequest;

class NotificationController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }
    public function show(ShowRequest $request)
    {
        return $request->run();
    }
    public function send(SendRequest $request)
    {
        return $request->run();
    }
    public function read(ReadRequest $request)
    {
        return $request->run();
    }
}
