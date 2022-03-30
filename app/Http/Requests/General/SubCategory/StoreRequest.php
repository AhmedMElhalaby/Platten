<?php

namespace App\Http\Requests\General\SubCategory;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\SubCategoryResource;
use App\Models\SubCategory;
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
            'name'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'category_id'=>__('models.SubCategory.category_id'),
            'name'=>__('models.SubCategory.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $SubCategory = new SubCategory();
        $SubCategory->category_id = $this->category_id;
        $SubCategory->name = $this->name;
        $SubCategory->save();
        $SubCategory->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'SubCategory'=>new SubCategoryResource($SubCategory)
        ]);
    }
}
