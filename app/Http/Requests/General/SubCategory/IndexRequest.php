<?php

namespace App\Http\Requests\General\SubCategory;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'category_id'=>'nullable|exists:categories,id',
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $SubCategories = (new SubCategory())->when($this->filled('q'),function($q){
            return $q->where('name','Like','%'.$this->q.'%');
        })->when($this->filled('category_id'),function($q){
            return $q->where('category_id',$this->category_id);
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'SubCategories'=>SubCategoryResource::collection($SubCategories->items())
        ],[
            'SubCategories'=>$SubCategories
        ]);
    }
}
