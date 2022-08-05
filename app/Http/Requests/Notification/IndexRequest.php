<?php

namespace App\Http\Requests\Notification;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('vendor')->check() || auth('customer')->check() || auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
        ];
    }
    public function attributes(): array
    {
        return [
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        if (auth('vendor')->check()){
            $user = auth('vendor')->user();
            $type = Notification::TargetTypes['Vendor'];
        }else if (auth('customer')->check()){
            $user = auth('customer')->user();
            $type = Notification::TargetTypes['Customer'];
        }else{
            $user = auth('employee')->user();
            $type = Notification::TargetTypes['Employee'];
        }
        $Notifications = (new Notification())->where('ref_id',$user->id)->where('target_type',$type)->paginate($this->per_page??10);
        return $this->success_response([],[
            'Notifications'=>NotificationResource::collection($Notifications->items())
        ],[
            'Notifications'=>$Notifications
        ]);
    }
}
