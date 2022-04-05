<?php

namespace App\Http\Requests\Vendor\Statistic;

use App\Http\Requests\ApiRequest;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class HomeRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('vendor')->check();
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'balance'=>Transaction::where('account_type',Transaction::AccountTypes['Vendor'])->where('account_id',auth('vendor')->user()->id)->where('type',Transaction::Types['Deposit'])->where('status',Transaction::Statuses['Placed'])->sum('amount'),
            'total_sales'=>Order::where('vendor_id',auth('vendor')->user()->id)->where('status',Order::Statuses['Finished'])->sum('total_amount'),
            'total_profits'=>Order::where('vendor_id',auth('vendor')->user()->id)->where('status',Order::Statuses['Finished'])->selectRaw('SUM(total_amount - cost) as total_profit')->sum('total_profit'),
            'month_sales'=>Order::whereMonth('created_at',Carbon::today()->month)->where('vendor_id',auth('vendor')->user()->id)->where('status',Order::Statuses['Finished'])->sum('total_amount'),
            'month_profits'=>Order::whereMonth('created_at',Carbon::today()->month)->where('vendor_id',auth('vendor')->user()->id)->where('status',Order::Statuses['Finished'])->selectRaw('SUM(total_amount - cost) as total_profit')->sum('total_profit'),
            'month_orders'=>Order::whereMonth('created_at',Carbon::today()->month)->where('vendor_id',auth('vendor')->user()->id)->where('status',Order::Statuses['Finished'])->count(),
        ]);
    }
}
