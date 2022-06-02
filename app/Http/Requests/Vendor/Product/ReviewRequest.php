<?php

namespace App\Http\Requests\Vendor\Product;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\ProductResource;
use App\Http\Resources\Vendor\ReviewResource;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'product_id'=>'required|exists:products,id',
            'per_page'=>'nullable|numeric',
        ];
    }
    public function attributes(): array
    {
        return [
            'product_id'=>__('models.Review.product_id'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Reviews = (new Review())->where('product_id',$this->product_id)->paginate($this->per_page??10);
        return $this->success_response([],['Reviews'=>ReviewResource::collection($Reviews->items())],['Reviews'=>$Reviews]);
    }
}
