<?php

namespace App\Http\Requests\General\SubCategory;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'sub_category_id'=>'required|exists:sub_categories,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'sub_category_id'=>__('models.SubCategory.sub_category_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'SubCategory'=>new SubCategoryResource(SubCategory::find($this->sub_category_id))
        ]);
    }
}
