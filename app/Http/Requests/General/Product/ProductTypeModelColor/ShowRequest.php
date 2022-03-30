<?php

namespace App\Http\Requests\General\Product\ProductTypeModelColor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelColorResource;
use App\Models\ProductTypeModelColor;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_type_model_color_id'=>'required|exists:products_types_models_colors,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_color_id'=>__('models.ProductTypeModelColor.product_type_model_color_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'ProductTypeModelColor'=>new ProductTypeModelColorResource(ProductTypeModelColor::find($this->product_type_model_color_id))
        ]);
    }
}
