<?php

namespace App\Http\Requests\General\Category;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'category_id'=>'required|exists:categories,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'category_id'=>__('models.Category.category_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],[
            'Category'=>new CategoryResource(Category::find($this->category_id))
        ]);
    }
}
