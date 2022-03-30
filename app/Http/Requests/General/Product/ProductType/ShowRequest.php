<?php

namespace App\Http\Requests\General\Product\ProductType;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeResource;
use App\Models\ProductType;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_type_id'=>'required|exists:products_types,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_id'=>__('models.ProductType.product_type_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'ProductType'=>new ProductTypeResource(ProductType::find($this->product_type_id))
        ]);
    }
}
