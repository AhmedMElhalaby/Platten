<?php

namespace App\Http\Requests\General\Country;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CountryResource;
use App\Models\Country;
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
        $Countries = (new Country())->when($this->filled('q'),function($q){
            return $q->where('name','Like','%'.$this->q.'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'Countries'=>CountryResource::collection($Countries->items())
        ],[
            'Countries'=>$Countries
        ]);
    }
}
