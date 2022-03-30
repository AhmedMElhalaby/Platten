<?php

namespace App\Http\Requests\General\SubCategory;

use App\Http\Requests\ApiRequest;
use App\Models\SubCategory;
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
            'sub_category_id'=>'required|exists:sub_categories,id',
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
        $SubCategory = (new SubCategory())->find($this->sub_category_id);
        try {
            $SubCategory->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
