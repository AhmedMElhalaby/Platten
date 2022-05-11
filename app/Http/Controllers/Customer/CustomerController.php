<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Auth\DestroyRequest;
use App\Http\Requests\Customer\Auth\ForgetPasswordRequest;
use App\Http\Requests\Customer\Auth\IndexRequest;
use App\Http\Requests\Customer\Auth\LoginRequest;
use App\Http\Requests\Customer\Auth\LogoutRequest;
use App\Http\Requests\Customer\Auth\RegisterRequest;
use App\Http\Requests\Customer\Auth\ResetPasswordRequest;
use App\Http\Requests\Customer\Auth\ShowRequest;
use App\Http\Requests\Customer\Auth\StoreRequest;
use App\Http\Requests\Customer\Auth\UpdatePasswordRequest;
use App\Http\Requests\Customer\Auth\UpdateRequest;

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
    public function update_password(UpdatePasswordRequest $request)
    {
        return $request->run();
    }
    public function destroy(DestroyRequest $request)
    {
        return $request->run();
    }
    public function forget_password(ForgetPasswordRequest $request)
    {
        return $request->run();
    }
    public function reset_password(ResetPasswordRequest $request)
    {
        return $request->run();
    }
}
