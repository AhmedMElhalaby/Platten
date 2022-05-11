<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Auth\DestroyRequest;
use App\Http\Requests\Employee\Auth\ForgetPasswordRequest;
use App\Http\Requests\Employee\Auth\IndexRequest;
use App\Http\Requests\Employee\Auth\LoginRequest;
use App\Http\Requests\Employee\Auth\LogoutRequest;
use App\Http\Requests\Employee\Auth\ResetPasswordRequest;
use App\Http\Requests\Employee\Auth\ShowRequest;
use App\Http\Requests\Employee\Auth\StoreRequest;
use App\Http\Requests\Employee\Auth\UpdatePasswordRequest;
use App\Http\Requests\Employee\Auth\UpdateRequest;

class EmployeeController extends Controller
{
    public function login(LoginRequest $request)
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
