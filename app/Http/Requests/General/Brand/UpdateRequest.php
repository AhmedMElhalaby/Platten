<?php

namespace App\Http\Requests\General\Brand;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BrandResource;
use App\Models\Brand;
use App\Models\BrandSubCategory;
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
            'brand_id'=>'required|exists:brands,id',
            'name'=>'nullable|string|max:255',
            'sub_categories'=>'nullable|array',
            'sub_categories.*'=>'nullable|exists:sub_categories,id',

        ];
    }
    public function attributes(): array
    {
        return [
            'brand_id'=>__('models.Brand.brand_id'),
            'name'=>__('models.Brand.name'),
            'sub_categories'=>__('models.Brand.sub_categories'),
            'sub_categories.*'=>__('models.Brand.sub_categories'),
        ];
    }
    public function run(): JsonResponse
    {
        $Brand = (new Brand())->find($this->brand_id);
        if ($this->filled('name')) {
            $Brand->name = $this->name;
        }
        $Brand->save();
        if ($this->filled('sub_categories') && is_array($this->sub_categories)){
            $Brand->brand_sub_categories()->delete();
            foreach($this->sub_categories as $sub_category_id){
                $BrandSubCategory = new BrandSubCategory();
                $BrandSubCategory->sub_category_id = $sub_category_id;
                $BrandSubCategory->brand_id = $Brand->id;
                $BrandSubCategory->save();
            }
        }
        return $this->success_response([__('messages.updated_successful')],[
            'Brand'=>new BrandResource($Brand)
        ]);
    }
}
