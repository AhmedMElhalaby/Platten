<?php

namespace App\Http\Requests\General\Brand;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'brand_id'=>'required|exists:brands,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'brand_id'=>__('models.Brand.brand_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Brand'=>new BrandResource(Brand::find($this->brand_id))
        ]);
    }
}
