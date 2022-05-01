<?php

namespace App\Http\Resources\General\Product;

use App\Http\Resources\General\BrandResource;
use App\Http\Resources\General\CategoryResource;
use App\Http\Resources\General\SubCategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'category_id'=>$this->category_id,
            'Category'=>new CategoryResource($this->category),
            'sub_category_id'=>$this->sub_category_id,
            'SubCategory'=>new SubCategoryResource($this->sub_category),
            'brand_id'=>$this->brand_id,
            'Brand'=>new BrandResource($this->brand),
            'name'=>$this->name,
        ];
    }
}
