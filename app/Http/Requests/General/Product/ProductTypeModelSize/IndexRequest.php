<?php

namespace App\Http\Requests\General\Product\ProductTypeModelSize;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelSizeResource;
use App\Models\ProductTypeModelSize;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_type_model_id'=>'nullable|exists:products_types_models,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_model_id'=>__('models.ProductTypeModelSize.product_type_model_id'),
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModelSizes = (new ProductTypeModelSize())->when($this->filled('product_type_model_id'),function ($q){
            return $q->where('product_type_model_id',$this->product_type_model_id);
        })->when($this->filled('q'),function($q){
            return $q->where('question','Like','%'.$this->q.'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'ProductTypeModelSizes'=>ProductTypeModelSizeResource::collection($ProductTypeModelSizes->items())
        ],[
            'ProductTypeModelSizes'=>$ProductTypeModelSizes
        ]);
    }
}
