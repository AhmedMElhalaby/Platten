<?php

namespace App\Http\Requests\General\Product\ProductTypeModelSize;

use App\Http\Requests\ApiRequest;
use App\Models\ProductTypeModelSize;
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
        $ProductTypeModelSize = (new ProductTypeModelSize())->find($this->product_type_model_size_id);
        try{
            $ProductTypeModelSize->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
