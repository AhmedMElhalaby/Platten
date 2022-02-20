<?php

namespace App\Http\Requests\Country;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
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
            'code'=>'required|numeric',
            'flag'=>'nullable|mimes:png,svg'
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Country.name'),
            'code'=>__('models.Country.code'),
            'flag'=>__('models.Country.flag'),
        ];
    }
    public function run(): JsonResponse
    {
        $Country = new Country();
        $Country->name = $this->name;
        $Country->code = $this->code;
        if ($this->hasFile('flag')) {
            $Country->flag = $this->flag;
        }
        $Country->save();
        $Country->refresh();
        return $this->success_response([__('messages.created_successful')],new CountryResource($Country),'Country');
    }
}
