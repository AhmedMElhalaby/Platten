<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Statistic\HomeRequest;

class StatisticController extends Controller
{
    public function home(HomeRequest $request)
    {
        return $request->run();
    }
}
