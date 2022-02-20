<?php

namespace App\Http\Requests\Country;

use App\Http\Requests\ApiRequest;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'country_id'=>'required|exists:countries,id',
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
        $Country = (new Country())->find($this->country_id);
        $Country->delete();
        return $this->success_response([__('messages.deleted_successfully')]);
    }
}
