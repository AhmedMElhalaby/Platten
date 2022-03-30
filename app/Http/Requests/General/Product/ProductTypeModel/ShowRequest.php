<?php

namespace App\Http\Requests\General\Product\ProductTypeModel;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelResource;
use App\Models\ProductTypeModel;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_type_model_id'=>'required|exists:products_types_models,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_id'=>__('models.ProductTypeModel.product_type_model_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'ProductTypeModel'=>new ProductTypeModelResource(ProductTypeModel::find($this->product_type_model_id))
        ]);
    }
}
