<?php

namespace App\Http\Requests\General\Product\ProductTypeModel;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\Product\ProductTypeModelResource;
use App\Models\ProductTypeModel;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_type_id'=>'nullable|exists:products_types,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_type_id'=>__('models.ProductTypeModel.product_type_id'),
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $ProductTypeModels = (new ProductTypeModel())->when($this->filled('product_type_id'),function ($q){
            return $q->where('product_type_id',$this->product_type_id);
        })->when($this->filled('q'),function($q){
            return $q->where('name','Like','%'.$this->q.'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'ProductTypeModels'=>ProductTypeModelResource::collection($ProductTypeModels->items())
        ],[
            'ProductTypeModels'=>$ProductTypeModels
        ]);
    }
}
