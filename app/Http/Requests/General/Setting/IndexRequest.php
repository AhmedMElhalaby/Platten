<?php

namespace App\Http\Requests\General\Setting;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BrandResource;
use App\Http\Resources\General\SettingResource;
use App\Models\Brand;
use App\Models\BrandSubCategory;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255',
            'type'=>'nullable|in:'.implode(',',array_values(Setting::Types))
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
            'type'=>__('models.Setting.type'),
        ];
    }
    public function run(): JsonResponse
    {
        $data = $this->all();
        $Settings = (new Setting())->when($this->filled('q'),function($q) use ($data){
            return $q->where('name','Like','%'.$data['q'].'%');
        })->when($this->filled('type'),function($q) use ($data){
            return $q->where('type',$data['type']);
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'Settings'=>SettingResource::collection($Settings->items())
        ],[
            'Settings'=>$Settings
        ]);
    }
}
