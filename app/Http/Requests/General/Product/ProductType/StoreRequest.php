<?php

namespace App\Http\Requests\General\Product\ProductType;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeResource;
use App\Models\ProductType;
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
            'category_id'=>'required|exists:categories,id',
            'sub_category_id'=>'required|exists:sub_categories,id',
            'brand_id'=>'required|exists:brands,id',
            'name'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'category_id'=>__('models.ProductType.category_id'),
            'sub_category_id'=>__('models.ProductType.sub_category_id'),
            'brand_id'=>__('models.ProductType.brand_id'),
            'name'=>__('models.ProductType.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductType = new ProductType();
        $ProductType->category_id = $this->category_id;
        $ProductType->sub_category_id = $this->sub_category_id;
        $ProductType->brand_id = $this->brand_id;
        $ProductType->name = $this->name;
        $ProductType->save();
        $ProductType->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'ProductType'=>new ProductTypeResource($ProductType)
        ]);
    }
}
