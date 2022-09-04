<?php

namespace App\Http\Requests\Vendor\Product;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\ProductResource;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'vendor_id'=>'nullable|exists:vendors,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'vendor_id'=>__('models.Product.vendor_id'),
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Products = (new Product())->withCount('orders_products');
        $ProductTypes = new ProductType();
        if ($this->filled('vendor_id')) {
            $Products = $Products->where('vendor_id',$this->vendor_id);
        }
        if ($this->filled('category_id')) {
            $Products = $Products->where('category_id',$this->category_id);
            $ProductTypes = $ProductTypes->where('category_id',$this->category_id);
        }
        if ($this->filled('category_ids')) {
            $Products = $Products->whereIn('category_id',$this->category_ids);
            $ProductTypes = $ProductTypes->whereIn('category_id',$this->category_ids);
        }
        if ($this->filled('sub_category_id')) {
            $Products = $Products->where('sub_category_id',$this->sub_category_id);
            $ProductTypes = $ProductTypes->where('sub_category_id',$this->sub_category_id);
        }
        if ($this->filled('sub_category_ids')) {
            $Products = $Products->whereIn('sub_category_id',$this->sub_category_ids);
            $ProductTypes = $ProductTypes->whereIn('sub_category_id',$this->sub_category_ids);
        }
        if ($this->filled('brand_id')) {
            $Products = $Products->where('brand_id',$this->brand_id);
            $ProductTypes = $ProductTypes->where('brand_id',$this->brand_id);
        }
        if ($this->filled('brand_ids')) {
            $Products = $Products->whereIn('brand_id',$this->brand_ids);
            $ProductTypes = $ProductTypes->whereIn('brand_id',$this->brand_ids);
        }
        if ($this->filled('type')) {
            $Products = $Products->where('type',$this->type);
        }
        if ($this->filled('types')) {
            $Products = $Products->whereIn('type',$this->types);
        }
        if ($this->filled('price_from') && $this->filled('price_to')) {
            $Products = $Products->whereBetween('sell_price',[$this->price_from,$this->price_to]);
        }
        if ($this->filled('q')) {
            $ProductTypes = $ProductTypes->where('name','Like','%'.$this->q.'%')->pluck('id');
            $q = $this->q;
            $Products = $Products->where(function ($query) use ($ProductTypes,$q){
                return $query->whereIn('product_type_id',$ProductTypes)->orWhere('note','Like','%'.$q.'%');
            });
        }
        if ($this->filled('top_sell') && $this->top_sell) {
            $Products = $Products->orderBy('orders_products_count');
        }
        if ($this->filled('suggested') && $this->suggested) {
            $Products = $Products->inRandomOrder();
        }
        if ($this->filled('offered') && $this->offered) {
            $Products = $Products->where('discount','!=',0);
        }
        $ProductsCount = $Products->count();
        $Products = $Products->paginate($this->per_page??10);
        return $this->success_response([],['Products'=>ProductResource::collection($Products->items()),'ProductsCount'=>$ProductsCount],['Products'=>$Products]);
    }
}
