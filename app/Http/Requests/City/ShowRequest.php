<?php

namespace App\Http\Requests\City;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CityResource;
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
        return $this->success_response([],new CityResource(City::find($this->city_id)),'City');
    }
}
