<?php

namespace App\Http\Requests\Notification;

use App\Http\Requests\ApiRequest;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ReadRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('vendor')->check() || auth('customer')->check() || auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'notification_id'=>'nullable|exists:notifications,id',
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
        if($this->filled('notification_id')){
            $Notification = (new Notification())->find($this->notification_id);
            $Notification->read_at = Carbon::now();
            $Notification->save();
        }else{
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
            (new Notification())->where('ref_id',$user->id)->where('target_type',$type)->whereNull('read_at')->update([
                'read_at'=>Carbon::now()
            ]);
        }
        return $this->success_response([__('messages.updated_successful')]);
    }
}
