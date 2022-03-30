<?php

namespace App\Http\Requests\General\City;

use App\Http\Requests\ApiRequest;
use App\Models\City;
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
            'city_id'=>'required|exists:cities,id',
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
        $City = (new City())->find($this->city_id);
        try {
            $City->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
