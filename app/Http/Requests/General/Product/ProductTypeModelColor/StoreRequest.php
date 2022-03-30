<?php

namespace App\Http\Requests\General\Product\ProductTypeModelColor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelColorResource;
use App\Models\ProductTypeModelColor;
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
            'product_type_model_id'=>'required|exists:products_types_models,id',
            'name'=>'required|string|max:255',
            'color_hash'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_id'=>__('models.ProductTypeModelColor.product_type_model_id'),
            'name'=>__('models.ProductTypeModelColor.name'),
            'color_hash'=>__('models.ProductTypeModelColor.color_hash'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModelColor = new ProductTypeModelColor();
        $ProductTypeModelColor->product_type_model_id = $this->product_type_model_id;
        $ProductTypeModelColor->name = $this->name;
        $ProductTypeModelColor->color_hash = $this->color_hash;
        $ProductTypeModelColor->save();
        $ProductTypeModelColor->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'ProductTypeModelColor'=>new ProductTypeModelColorResource($ProductTypeModelColor)
        ]);
    }
}
