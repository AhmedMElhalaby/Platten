<?php

namespace App\Http\Requests\General\Product\ProductTypeModelSize;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelSizeResource;
use App\Models\ProductTypeModelSize;
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
            'product_type_model_size_id'=>'required|exists:products_types_models_sizes,id',
            'product_type_model_id'=>'nullable|exists:products_types_models,id',
            'name'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_size_id'=>__('models.ProductTypeModelSize.product_type_model_size_id'),
            'product_type_model_id'=>__('models.ProductTypeModelSize.product_type_model_id'),
            'name'=>__('models.ProductTypeModelSize.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModelSize = (new ProductTypeModelSize())->find($this->product_type_model_size_id);
        if ($this->filled('product_type_model_id')) {
            $ProductTypeModelSize->product_type_model_id = $this->product_type_model_id;
        }
        if ($this->filled('name')) {
            $ProductTypeModelSize->name = $this->name;
        }
        $ProductTypeModelSize->save();
        $ProductTypeModelSize->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'ProductTypeModelSize'=>new ProductTypeModelSizeResource($ProductTypeModelSize)
        ]);
    }
}
