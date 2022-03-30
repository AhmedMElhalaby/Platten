<?php

namespace App\Http\Requests\General\Product\ProductType;

use App\Http\Requests\ApiRequest;
use App\Models\ProductType;
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
            'product_type_id'=>'required|exists:products_types,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_id'=>__('models.ProductType.product_type_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductType = (new ProductType())->find($this->product_type_id);
        try{
            $ProductType->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
