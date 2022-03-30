<?php

namespace App\Http\Requests\General\Product\ProductTypeModel;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelResource;
use App\Models\ProductTypeModel;
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
            'product_type_id'=>'required|exists:products_types,id',
            'name'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_id'=>__('models.ProductTypeModel.product_type_id'),
            'name'=>__('models.ProductTypeModel.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModel = new ProductTypeModel();
        $ProductTypeModel->product_type_id = $this->product_type_id;
        $ProductTypeModel->name = $this->name;
        $ProductTypeModel->save();
        $ProductTypeModel->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'ProductTypeModel'=>new ProductTypeModelResource($ProductTypeModel)
        ]);
    }
}
