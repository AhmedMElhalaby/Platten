<?php

namespace App\Http\Requests\General\Product\ProductTypeModelColor;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelColorResource;
use App\Models\ProductTypeModelColor;
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
            'product_type_model_id'=>__('models.ProductTypeModelColor.product_type_model_id'),
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModelColors = (new ProductTypeModelColor())->when($this->filled('product_type_model_id'),function ($q){
            return $q->where('product_type_model_id',$this->product_type_model_id);
        })->when($this->filled('q'),function($q){
            return $q->where('question','Like','%'.$this->q.'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'ProductTypeModelColors'=>ProductTypeModelColorResource::collection($ProductTypeModelColors->items())
        ],[
            'ProductTypeModelColors'=>$ProductTypeModelColors
        ]);
    }
}
