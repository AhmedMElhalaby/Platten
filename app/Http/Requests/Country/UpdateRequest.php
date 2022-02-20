<?php

namespace App\Http\Requests\Country;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
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
            'country_id'=>'required|exists:countries,id',
            'name'=>'nullable|string|max:255',
            'code'=>'nullable|numeric',
            'flag'=>'nullable|mimes:png,svg'
        ];
    }
    public function attributes(): array
    {
        return [
            'country_id'=>__('models.Country.country_id'),
            'name'=>__('models.Country.name'),
            'code'=>__('models.Country.code'),
            'flag'=>__('models.Country.flag'),
        ];
    }
    public function run(): JsonResponse
    {
        $Country = (new Country())->find($this->country_id);
        if ($this->filled('name')) {
            $Country->name = $this->name;
        }
        if ($this->filled('code')) {
            $Country->code = $this->code;
        }
        if ($this->hasFile('flag')) {
            $Country->flag = $this->flag;
        }
        $Country->save();
        $Country->refresh();
        return $this->success_response([__('messages.updated_successful')],new CountryResource($Country),'Country');
    }
}
