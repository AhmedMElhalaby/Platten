<?php

namespace App\Http\Requests\General\Product\ProductTypeModelSize;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelSizeResource;
use App\Models\ProductTypeModelSize;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_type_model_size_id'=>'required|exists:products_types_models_sizes,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_size_id'=>__('models.ProductTypeModelSize.product_type_model_size_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'ProductTypeModelSize'=>new ProductTypeModelSizeResource(ProductTypeModelSize::find($this->product_type_model_size_id))
        ]);
    }
}
