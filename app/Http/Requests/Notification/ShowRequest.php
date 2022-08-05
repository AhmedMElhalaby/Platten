<?php

namespace App\Http\Requests\Notification;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CategoryResource;
use App\Http\Resources\NotificationResource;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('vendor')->check() || auth('customer')->check() || auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'notification_id'=>'required|exists:notifications,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'notification_id'=>__('models.Notification.notification_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Notification'=>new NotificationResource(Notification::find($this->notification_id))
        ]);
    }
}
