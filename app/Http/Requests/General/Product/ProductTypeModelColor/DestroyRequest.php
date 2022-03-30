<?php

namespace App\Http\Requests\General\Product\ProductTypeModelColor;

use App\Http\Requests\ApiRequest;
use App\Models\ProductTypeModelColor;
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
        $ProductTypeModelColor = (new ProductTypeModelColor())->find($this->product_type_model_color_id);
        try{
            $ProductTypeModelColor->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
