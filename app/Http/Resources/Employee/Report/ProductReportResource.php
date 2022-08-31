<?php

namespace App\Http\Resources\Employee\Report;

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
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductReportResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'=>$this->id,
            'vendor_name'=>$this->vendor->name,
            'category_name'=>$this->category->name,
            'sub_category_name'=>$this->sub_category->name,
            'brand_name'=>$this->brand->name,
            'product_type_name'=>$this->product_type->name,
            'type'=>Product::TypesStr[$this->type],
            'quantity'=>$this->quantity,
            'cost_price'=>$this->cost_price,
            'profit_rate'=>$this->profit_rate,
            'sell_price'=>$this->sell_price,
            'discount'=>$this->discount,
            'status'=>$this->status,
            'sold_quantity'=>$this->sold_quantity,
            'note'=>$this->note,
            'created_at'=>Carbon::parse($this->created_at)->format('d M, Y H:i A')
        ];
    }
}
