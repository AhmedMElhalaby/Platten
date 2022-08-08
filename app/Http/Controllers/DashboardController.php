<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\StatisticsRequest;

class DashboardController extends Controller
{
    public function statistics(StatisticsRequest $request)
    {
        return $request->run();
    }
}
