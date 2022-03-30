<?php

namespace App\Http\Requests\General\Brand;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\BrandResource;
use App\Models\Brand;
use App\Models\BrandSubCategory;
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
            'sub_categories'=>'required|array',
            'sub_categories.*'=>'required|exists:sub_categories,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Brand.name'),
            'sub_categories'=>__('models.Brand.sub_categories'),
            'sub_categories.*'=>__('models.Brand.sub_categories'),
        ];
    }
    public function run(): JsonResponse
    {
        $Brand = new Brand();
        $Brand->name = $this->name;
        $Brand->save();
        $Brand->refresh();
        if ($this->filled('sub_categories') && is_array($this->sub_categories)){
            foreach($this->sub_categories as $sub_category_id){
                $BrandSubCategory = new BrandSubCategory();
                $BrandSubCategory->sub_category_id = $sub_category_id;
                $BrandSubCategory->brand_id = $Brand->id;
                $BrandSubCategory->save();
            }
        }
        return $this->success_response([__('messages.created_successful')],[
            'Brand'=>new BrandResource($Brand)
        ]);
    }
}
