<?php

namespace App\Http\Requests\General\Advertisement;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $data = $this->all();
        $Advertisements = (new Advertisement())->when($this->filled('q'),function($q) use ($data){
            return $q->where('name','Like','%'.$data['q'].'%');
        })->when($this->filled('type'),function($q) use ($data){
            return $q->where('type','Like','%'.$data['type'].'%');
        })->when($this->filled('order'),function($q) use ($data){
            return $q->where('order','Like','%'.$data['order'].'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'Advertisements'=>AdvertisementResource::collection($Advertisements->items())
        ],[
            'Advertisements'=>$Advertisements
        ]);
    }
}
