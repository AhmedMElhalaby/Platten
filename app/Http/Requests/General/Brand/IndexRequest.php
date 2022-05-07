<?php

namespace App\Http\Requests\General\Brand;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BrandResource;
use App\Models\Brand;
use App\Models\BrandSubCategory;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'sub_category_id'=>'nullable|exists:sub_categories,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
            'category_id'=>__('models.Brand.category_id'),
            'sub_category_id'=>__('models.Brand.sub_category_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Brands = (new Brand())->when($this->filled('q'),function($q){
            return $q->where('name','Like','%'.$this->q.'%');
        })->when($this->filled('sub_category_id'),function($q){
            $BrandsId = BrandSubCategory::where('sub_category_id',$this->sub_category_id)->pluck('brand_id');
            return $q->whereIn('id',$BrandsId);
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'Brands'=>BrandResource::collection($Brands->items())
        ],[
            'Brands'=>$Brands
        ]);
    }
}
