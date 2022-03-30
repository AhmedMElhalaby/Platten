<?php

namespace App\Http\Requests\General\City;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CityResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'city_id'=>'required|exists:cities,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'city_id'=>__('models.City.city_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'City'=>new CityResource(City::find($this->city_id))
        ]);
    }
}
