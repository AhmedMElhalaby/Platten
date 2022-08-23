<?php

namespace App\Http\Requests\General\Category;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CategoryResource;
use App\Models\Category;
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
            'category_id'=>'required|exists:categories,id',
            'name'=>'nullable|string|max:255',
            'image'=>'nullable|mimes:png,jpg,jpeg',
        ];
    }
    public function attributes(): array
    {
        return [
            'category_id'=>__('models.Category.category_id'),
            'name'=>__('models.Category.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Category = (new Category())->find($this->category_id);
        if ($this->filled('name')) {
            $Category->name = $this->name;
        }
        if ($this->hasFile('image')) {
            $path = $this->file('image')->store('public/categories');
            $Category->image = $path;
        }
        $Category->save();
        $Category->refresh();
        return $this->success_response([__('messages.updated_successful')],[
            'Category'=>new CategoryResource($Category)
        ]);
    }
}
