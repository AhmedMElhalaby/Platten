<?php

namespace App\Http\Requests\General\Product\ProductTypeModel;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelResource;
use App\Models\ProductTypeModel;
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
            'product_type_model_id'=>'required|exists:products_types_models,id',
            'product_type_id'=>'nullable|exists:products_types,id',
            'name'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_id'=>__('models.ProductTypeModel.product_type_model_id'),
            'product_type_id'=>__('models.ProductTypeModel.product_type_id'),
            'name'=>__('models.ProductTypeModel.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModel = (new ProductTypeModel())->find($this->product_type_model_id);
        if ($this->filled('product_type_id')) {
            $ProductTypeModel->product_type_id = $this->product_type_id;
        }
        if ($this->filled('name')) {
            $ProductTypeModel->name = $this->name;
        }
        $ProductTypeModel->save();
        $ProductTypeModel->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'ProductTypeModel'=>new ProductTypeModelResource($ProductTypeModel)
        ]);
    }
}
