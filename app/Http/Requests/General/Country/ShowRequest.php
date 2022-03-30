<?php

namespace App\Http\Requests\General\Country;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CountryResource;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'country_id'=>'required|exists:countries,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'country_id'=>__('models.Country.country_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Country'=>new CountryResource(Country::find($this->country_id))
        ]);
    }
}
