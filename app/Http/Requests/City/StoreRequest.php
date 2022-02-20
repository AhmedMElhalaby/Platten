<?php

namespace App\Http\Requests\City;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\JsonResponse;

class StoreRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'name'=>'required|string|max:255',
            'country_id'=>'required|exists:countries,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.City.name'),
            'country_id'=>__('models.City.country_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $City = new City();
        $City->name = $this->name;
        $City->country_id = $this->country_id;
        $City->save();
        $City->refresh();
        return $this->success_response([__('messages.created_successful')],new CityResource($City),'City');
    }
}
