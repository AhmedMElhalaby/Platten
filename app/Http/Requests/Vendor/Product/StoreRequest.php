<?php

namespace App\Http\Requests\Vendor\Product;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\ProductResource;
use App\Models\Product;
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
            'product_type_id'=>'required|exists:products_types,id',
            'product_type_model_id'=>'required|exists:products_types_models,id',
            'product_type_model_color_id'=>'required|exists:products_types_models_colors,id',
            'product_type_model_size_id'=>'required|exists:products_types_models_sizes,id',
            'cost_price'=>'required|numeric',
            'profit_rate'=>'required|numeric',
            'discount'=>'nullable|numeric',
        ];
    }
    public function attributes(): array
    {
        return [
            'category_id'=>__('models.Product.category_id'),
            'sub_category_id'=>__('models.Product.sub_category_id'),
            'brand_id'=>__('models.Product.brand_id'),
            'product_type_id'=>__('models.Product.product_type_id'),
            'product_type_model_id'=>__('models.Product.product_type_model_id'),
            'product_type_model_color_id'=>__('models.Product.product_type_model_color_id'),
            'product_type_model_size_id'=>__('models.Product.product_type_model_size_id'),
            'cost_price'=>__('models.Product.cost_price'),
            'profit_rate'=>__('models.Product.profit_rate'),
            'discount'=>__('models.Product.discount'),
        ];
    }
    public function run(): JsonResponse
    {
        $Product = new Product();
        $Product->vendor_id = auth('vendor')->user()->id;
        $Product->category_id = $this->category_id;
        $Product->sub_category_id = $this->sub_category_id;
        $Product->brand_id = $this->brand_id;
        $Product->product_type_id = $this->product_type_id;
        $Product->product_type_model_id = $this->product_type_model_id;
        $Product->product_type_model_color_id = $this->product_type_model_color_id;
        $Product->product_type_model_size_id = $this->product_type_model_size_id;
        $Product->cost_price = $this->cost_price;
        $Product->profit_rate = $this->profit_rate;
        $Product->sell_price = $this->cost_price + $this->profit_rate;
        $Product->discount = $this->discount;
        $Product->save();
        $Product->refresh();
        return $this->success_response([__('messages.created_successful')],['Product'=>new ProductResource($Product)]);
    }
}
