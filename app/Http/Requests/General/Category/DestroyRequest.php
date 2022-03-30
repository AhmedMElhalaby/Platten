<?php

namespace App\Http\Requests\General\Category;

use App\Http\Requests\ApiRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class DestroyRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'category_id'=>'required|exists:categories,id',
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
        $Category = (new Category())->find($this->category_id);
        try {
            $Category->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
