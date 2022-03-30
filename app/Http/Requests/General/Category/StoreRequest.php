<?php

namespace App\Http\Requests\General\Category;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CategoryResource;
use App\Models\Category;
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
            'name'=>'required|string|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Category.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Category = new Category();
        $Category->name = $this->name;
        $Category->save();
        $Category->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'Category'=>new CategoryResource($Category)
        ]);
    }
}
