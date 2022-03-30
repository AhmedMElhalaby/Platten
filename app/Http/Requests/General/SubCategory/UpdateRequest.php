<?php

namespace App\Http\Requests\General\SubCategory;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubCategoryResource;
use App\Models\SubCategory;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'sub_category_id'=>'required|exists:sub_categories,id',
            'category_id'=>'required|exists:categories,id',
            'name'=>'nullable|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'sub_category_id'=>__('models.SubCategory.sub_category_id'),
            'category_id'=>__('models.SubCategory.category_id'),
            'name'=>__('models.SubCategory.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $SubCategory = (new SubCategory())->find($this->sub_category_id);
        if ($this->filled('name')) {
            $SubCategory->name = $this->name;
        }
        if ($this->filled('category_id')) {
            $SubCategory->category_id = $this->category_id;
        }
        $SubCategory->save();
        $SubCategory->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'SubCategory'=>new SubCategoryResource($SubCategory)
        ]);
    }
}
