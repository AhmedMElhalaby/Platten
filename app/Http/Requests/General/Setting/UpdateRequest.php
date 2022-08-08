<?php

namespace App\Http\Requests\General\Setting;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SettingResource;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'setting_id'=>'required_without:key|exists:settings,id',
            'key'=>'required_without:setting_id|exists:settings,key',
            'value'=>'required|string',
        ];
    }
    public function attributes(): array
    {
        return [
            'setting_id'=>__('models.Setting.setting_id'),
            'key'=>__('models.Setting.key'),
            'value'=>__('models.Setting.value'),
        ];
    }
    public function run(): JsonResponse
    {
        $Setting = $this->filled('setting_id')?Setting::find($this->setting_id):
            Setting::where('key',$this->key)->first();
        $Setting->value = $this->value;
        $Setting->save();
        return $this->success_response([__('messages.updated_successful')],[
            'Setting'=>new SettingResource($Setting)
        ]);
    }
}
