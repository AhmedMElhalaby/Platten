<?php

namespace App\Http\Requests\Employee\Report;

use App\Export\ProductExport;
use App\Http\Requests\ApiRequest;
use App\Http\Resources\Employee\Report\ProductReportResource;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;

class ProductRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'from_date'=>'nullable|date',
            'to_date'=>'nullable|date',
            'product_type_id'=>'nullable|exists:products_types,id',
            'category_id'=>'nullable|exists:categories,id',
            'vendor_id'=>'nullable|exists:vendors,id',
            'sub_category_id'=>'nullable|exists:sub_categories,id',
            'brand_id'=>'nullable|exists:brands,id',
        ];
    }
    public function run(): JsonResponse
    {
        $Products = (new Product())->with(['vendor','product_type','category','sub_category','brand']);
        if ($this->filled('product_type_id')){
            $Products = $Products->where('product_type_id',$this->product_type_id);
        }
        if ($this->filled('category_id')){
            $Products = $Products->where('category_id',$this->category_id);
        }
        if ($this->filled('vendor_id')){
            $Products = $Products->where('vendor_id',$this->vendor_id);
        }
        if ($this->filled('sub_category_id')){
            $Products = $Products->where('sub_category_id',$this->sub_category_id);
        }
        if ($this->filled('brand_id')){
            $Products = $Products->where('brand_id',$this->brand_id);
        }
        if ($this->filled('from_date') && $this->filled('to_date')){
            $Products = $Products->whereBetween('created_at',[Carbon::parse($this->from_date),Carbon::parse($this->to_date)]);
        }
        if ($this->filled('from_date') && !$this->filled('to_date')){
            $Products = $Products->where('created_at','>=',Carbon::parse($this->from_date));
        }
        if (!$this->filled('from_date') && $this->filled('to_date')){
            $Products = $Products->where('created_at','<=',Carbon::parse($this->from_date));
        }
        $Products = $Products->get();
        $ProductsResource = ProductReportResource::collection($Products);
        $file_path = 'reports/Products-Report-'.now()->format('Y-m-d-H-i-A').'.xlsx';
        Excel::store(new ProductExport($ProductsResource),'public/'.$file_path);
        return $this->success_response([],
        [
            'count'=>count($Products),
            'Products'=>$ProductsResource,
            'excel'=> asset('storage/'.$file_path)
        ]);
    }
}
