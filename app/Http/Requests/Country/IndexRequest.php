<?php

namespace App\Http\Requests\Country;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Countries = new Country();
        if ($this->filled('q')) {
            $Countries = $Countries->where('name','Like','%'.$this->q.'%');
        }
        $Countries = $Countries->paginate($this->per_page??10);
        return $this->success_response([],CountryResource::collection($Countries->items()),'Countries',$Countries);
    }
}
