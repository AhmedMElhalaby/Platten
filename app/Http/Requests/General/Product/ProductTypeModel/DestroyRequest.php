<?php

namespace App\Http\Requests\General\Product\ProductTypeModel;

use App\Http\Requests\ApiRequest;
use App\Models\ProductTypeModel;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'product_type_model_id'=>'required|exists:products_types_models,id',
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
        $ProductTypeModel = (new ProductTypeModel())->find($this->product_type_model_id);
        try{
            $ProductTypeModel->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
