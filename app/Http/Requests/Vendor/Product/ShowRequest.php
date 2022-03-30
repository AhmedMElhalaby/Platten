<?php

namespace App\Http\Requests\Vendor\Product;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_id'=>'required|exists:products,id'
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
        return $this->success_response([],['Product'=>new ProductResource(Product::find($this->product_id))]);
    }
}
