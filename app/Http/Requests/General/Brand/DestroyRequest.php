<?php

namespace App\Http\Requests\General\Brand;

use App\Http\Requests\ApiRequest;
use App\Models\BrandSubCategory;
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
            'brand_id'=>'required|exists:brands,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'brand_id'=>__('models.Brand.brand_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Brand = (new BrandSubCategory())->find($this->brand_id);
        try {
            $Brand->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
