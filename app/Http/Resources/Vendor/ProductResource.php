<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\General\BrandResource;
use App\Http\Resources\General\CategoryResource;
use App\Http\Resources\General\Product\ProductTypeMediaResource;
use App\Http\Resources\General\Product\ProductTypeModelColorResource;
use App\Http\Resources\General\Product\ProductTypeModelResource;
use App\Http\Resources\General\Product\ProductTypeModelSizeResource;
use App\Http\Resources\General\Product\ProductTypeResource;
use App\Http\Resources\General\SubCategoryResource;
use App\Http\Resources\VendorResource;
use App\Models\Category;
use App\Models\Favourite;
use App\Models\Review;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'vendor_id'=>$this->vendor_id,
            'Vendor'=>new VendorResource($this->vendor),
            'category_id'=>$this->category_id,
            'Category'=>new CategoryResource($this->category),
            'sub_category_id'=>$this->sub_category_id,
            'SubCategory'=>new SubCategoryResource($this->sub_category),
            'brand_id'=>$this->brand_id,
            'Brand'=>new BrandResource($this->brand),
            'product_type_id'=>$this->product_type_id,
            'ProductType'=>new ProductTypeResource($this->product_type),
            'product_type_model_id'=>$this->product_type_model_id,
            'ProductTypeModel'=>new ProductTypeModelResource($this->product_type_model),
            'product_type_model_color_id'=>$this->product_type_model_color_id,
            'ProductTypeModelColor'=>new ProductTypeModelColorResource($this->product_type_model_color),
            'product_type_model_size_id'=>$this->product_type_model_size_id,
            'ProductTypeModelSize'=>new ProductTypeModelSizeResource($this->product_type_model_size),
            'ProductMedia'=>($this->product_type->media()->count() >0)?(ProductTypeMediaResource::collection($this->product_type->media)):[],
            'type'=>$this->type,
            'quantity'=>$this->quantity,
            'cost_price'=>$this->cost_price,
            'profit_rate'=>$this->profit_rate,
            'sell_price'=>$this->sell_price,
            'discount'=>$this->discount,
            'status'=>$this->status,
            'sold_quantity'=>$this->sold_quantity,
            'note'=>$this->note,
            'rate'=>(Review::where('product_id',$this->product_id)->avg('rate'))??0,
            'review_count'=>Review::where('product_id',$this->product_id)->count(),
            'is_favourite'=>(auth('customer')->check())?(Favourite::where('customer_id',auth('customer')->user()->id)->where('product_id',$this->id)->first()?1:0) :0
        ];
    }
}
