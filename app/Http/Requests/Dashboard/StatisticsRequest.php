<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CategoryResource;
use App\Http\Resources\NotificationResource;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;

class StatisticsRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [];
    }
    public function attributes(): array
    {
        return [];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Customers'=>Customer::count(),
            'Vendors'=>Vendor::count(),
            'Orders'=>Order::count()
        ]);
    }
}
