<?php

namespace App\Http\Requests\Vendor\Product;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('vendor')->check();
    }
    public function rules():array
    {
        return [
            'product_id'=>'required|exists:products,id',
            'category_id'=>'nullable|exists:categories,id',
            'sub_category_id'=>'nullable|exists:sub_categories,id',
            'brand_id'=>'nullable|exists:brands,id',
            'product_type_id'=>'nullable|exists:products_types,id',
            'product_type_model_id'=>'nullable|exists:products_types_models,id',
            'product_type_model_color_id'=>'nullable|exists:products_types_models_colors,id',
            'product_type_model_size_id'=>'nullable|exists:products_types_models_sizes,id',
            'cost_price'=>'nullable|numeric',
            'profit_rate'=>'nullable|numeric',
            'discount'=>'nullable|numeric',
            'status'=>'nullable|boolean',
            'type'=>'nullable|in:'.implode(',',array_values(Product::Types)),
        ];
    }
    public function attributes(): array
    {
        return [
            'product_id'=>__('models.Product.product_id'),
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
            'status'=>__('models.Product.status'),
            'type'=>__('models.Product.type'),
        ];
    }
    public function run(): JsonResponse
    {
        $Product = (new Product())->find($this->product_id);
        if ($this->filled('category_id')) {
            $Product->category_id = $this->category_id;
        }
        if ($this->filled('sub_category_id')) {
            $Product->sub_category_id = $this->sub_category_id;
        }
        if ($this->filled('brand_id')) {
            $Product->brand_id = $this->brand_id;
        }
        if ($this->filled('product_type_id')) {
            $Product->product_type_id = $this->product_type_id;
        }
        if ($this->filled('product_type_model_id')) {
            $Product->product_type_model_id = $this->product_type_model_id;
        }
        if ($this->filled('product_type_model_color_id')) {
            $Product->product_type_model_color_id = $this->product_type_model_color_id;
        }
        if ($this->filled('product_type_model_size_id')) {
            $Product->product_type_model_size_id = $this->product_type_model_size_id;
        }
        if ($this->filled('cost_price')) {
            $Product->cost_price = $this->cost_price;
        }
        if ($this->filled('profit_rate')) {
            $Product->profit_rate = $this->profit_rate;
        }
        if ($this->filled('discount')) {
            $Product->discount = $this->discount;
        }
        if ($this->filled('status')) {
            $Product->status = $this->status;
        }
        if ($this->filled('type')) {
            $Product->type = $this->type;
        }
        $Product->save();
        $Product->refresh();
        return $this->success_response([__('messages.updated_successful')],['Product'=>new ProductResource($Product)]);
    }
}
