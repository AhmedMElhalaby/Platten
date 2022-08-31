<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Report\CustomerRequest;
use App\Http\Requests\Employee\Report\OrderRequest;
use App\Http\Requests\Employee\Report\ProductRequest;
use App\Http\Requests\Employee\Report\VendorRequest;

class ReportController extends Controller
{
    public function customers(CustomerRequest $request)
    {
        return $request->run();
    }
    public function vendors(VendorRequest $request)
    {
        return $request->run();
    }
    public function products(ProductRequest $request)
    {
        return $request->run();
    }
    public function orders(OrderRequest $request)
    {
        return $request->run();
    }
}
