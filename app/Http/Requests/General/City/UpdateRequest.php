<?php

namespace App\Http\Requests\General\City;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CityResource;
use App\Models\City;
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
            'city_id'=>'required|exists:cities,id',
            'country_id'=>'nullable|exists:countries,id',
            'name'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'city_id'=>__('models.City.city_id'),
            'country_id'=>__('models.City.country_id'),
            'name'=>__('models.City.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $City = (new City())->find($this->city_id);
        if ($this->filled('name')) {
            $City->name = $this->name;
        }
        if ($this->filled('country_id')) {
            $City->country_id = $this->country_id;
        }
        $City->save();
        $City->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'City'=>new CityResource($City)
        ]);
    }
}
