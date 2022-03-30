<?php

namespace App\Http\Requests\General\Product\ProductTypeModelSize;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelSizeResource;
use App\Models\ProductTypeModelSize;
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
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_id'=>__('models.ProductTypeModelSize.product_type_model_id'),
            'name'=>__('models.ProductTypeModelSize.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModelSize = new ProductTypeModelSize();
        $ProductTypeModelSize->product_type_model_id = $this->product_type_model_id;
        $ProductTypeModelSize->name = $this->name;
        $ProductTypeModelSize->save();
        $ProductTypeModelSize->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'ProductTypeModelSize'=>new ProductTypeModelSizeResource($ProductTypeModelSize)
        ]);
    }
}
