<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\DestroyRequest;
use App\Http\Requests\Customer\IndexRequest;
use App\Http\Requests\Customer\LoginRequest;
use App\Http\Requests\Customer\LogoutRequest;
use App\Http\Requests\Customer\RegisterRequest;
use App\Http\Requests\Customer\ShowRequest;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;

class CustomerController extends Controller
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
