<?php

namespace App\Http\Requests\General\Category;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class IndexRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'per_page'=>'nullable|numeric',
            'q'=>'nullable|string|max:255'
        ];
    }
    public function attributes(): array
    {
        return [
            'q'=>__('models.q'),
            'per_page'=>__('models.per_page'),
        ];
    }
    public function run(): JsonResponse
    {
        $Categories = (new Category())->when($this->filled('q'),function($q){
            return $q->where('name','Like','%'.$this->q.'%');
        })->paginate($this->per_page??10);
        return $this->success_response([],[
            'Categories'=>CategoryResource::collection($Categories->items())
        ],[
            'Categories'=>$Categories
        ]);
    }
}
