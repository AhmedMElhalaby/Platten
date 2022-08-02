<?php

namespace App\Http\Requests\General\Setting;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BrandResource;
use App\Http\Resources\General\SettingResource;
use App\Models\Brand;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'setting_id'=>'required_without:key|exists:settings,id',
            'key'=>'required_without:setting_id|exists:settings,key'
        ];
    }
    public function attributes(): array
    {
        return [
            'setting_id'=>__('models.Setting.setting_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Setting'=>$this->filled('setting_id')?new SettingResource(Setting::find($this->setting_id)):
                new SettingResource(Setting::where('key',$this->key)->first())
        ]);
    }
}
