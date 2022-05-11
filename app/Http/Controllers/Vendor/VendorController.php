<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Auth\DestroyRequest;
use App\Http\Requests\Vendor\Auth\ForgetPasswordRequest;
use App\Http\Requests\Vendor\Auth\IndexRequest;
use App\Http\Requests\Vendor\Auth\LoginRequest;
use App\Http\Requests\Vendor\Auth\LogoutRequest;
use App\Http\Requests\Vendor\Auth\MeRequest;
use App\Http\Requests\Vendor\Auth\RegisterRequest;
use App\Http\Requests\Vendor\Auth\ResetPasswordRequest;
use App\Http\Requests\Vendor\Auth\ShowRequest;
use App\Http\Requests\Vendor\Auth\StoreRequest;
use App\Http\Requests\Vendor\Auth\UpdatePasswordRequest;
use App\Http\Requests\Vendor\Auth\UpdateRequest;

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
    public function me(MeRequest $request)
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
