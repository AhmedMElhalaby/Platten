<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vendor\LoginRequest;
use App\Http\Requests\Vendor\RegisterRequest;
use App\Http\Requests\Vendor\IndexRequest;
use App\Http\Requests\Vendor\ShowRequest;
use App\Http\Requests\Vendor\StoreRequest;
use App\Http\Requests\Vendor\UpdateRequest;
use App\Http\Requests\Vendor\DestroyRequest;

class VendorController extends Controller
{
    public function login(LoginRequest $request)
    {
        return $request->run();
    }
    public function register(RegisterRequest $request)
    {
        return $request->run();
    }
    public function logout(LogoutRequest $request)
    {
        return $request->run();
    }
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
