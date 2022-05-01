<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\DestroyRequest;
use App\Http\Requests\Vendor\ForgetPasswordRequest;
use App\Http\Requests\Vendor\IndexRequest;
use App\Http\Requests\Vendor\LoginRequest;
use App\Http\Requests\Vendor\LogoutRequest;
use App\Http\Requests\Vendor\MeRequest;
use App\Http\Requests\Vendor\RegisterRequest;
use App\Http\Requests\Vendor\ResetPasswordRequest;
use App\Http\Requests\Vendor\ShowRequest;
use App\Http\Requests\Vendor\StoreRequest;
use App\Http\Requests\Vendor\UpdateRequest;

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
