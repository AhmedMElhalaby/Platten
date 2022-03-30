<?php

namespace App\Http\Requests\Vendor\Product;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\Vendor\ProductResource;
use App\Models\Product;
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
        $Products = new Product();
        if ($this->filled('vendor_id')) {
            $Products = $Products->where('vendor_id',$this->vendor_id);
        }
        if ($this->filled('q')) {
            $Products = $Products->where('name','Like','%'.$this->q.'%');
        }
        $Products = $Products->paginate($this->per_page??10);
        return $this->success_response([],['Products'=>ProductResource::collection($Products->items())],['Products'=>$Products]);
    }
}
