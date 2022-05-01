<?php

namespace App\Http\Requests\Vendor\Product;

use App\Http\Requests\ApiRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('vendor')->check();
    }
    public function rules():array
    {
        return [
            'product_id'=>'required|exists:products,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_id'=>__('models.Product.product_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Product = (new Product())->find($this->product_id);
        try{
            $Product->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch(\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
