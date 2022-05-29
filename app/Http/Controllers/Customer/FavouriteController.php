<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Favourite\IndexRequest;
use App\Http\Requests\Customer\Favourite\ShowRequest;
use App\Http\Requests\Customer\Favourite\ToggleRequest;

class FavouriteController extends Controller
{
    public function index(IndexRequest $request)
    {
        return $request->run();
    }
    public function show(ShowRequest $request)
    {
        return $request->run();
    }
    public function toggle(ToggleRequest $request)
    {
        return $request->run();
    }
}
