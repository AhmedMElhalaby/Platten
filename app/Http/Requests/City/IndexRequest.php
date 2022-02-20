<?php

namespace App\Http\Requests\City;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'country_id'=>'nullable|exists:countries,id',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'country_id'=>__('models.City.country_id'),
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Cities = new City();
        if ($this->filled('q')) {
            $Cities = $Cities->where('name','Like','%'.$this->q.'%');
        }
        if ($this->filled('country_id')) {
            $Cities = $Cities->where('country_id',$this->country_id);
        }
        $Cities = $Cities->paginate($this->per_page??10);
        return $this->success_response([],CityResource::collection($Cities->items()),'Cities',$Cities);
    }
}
