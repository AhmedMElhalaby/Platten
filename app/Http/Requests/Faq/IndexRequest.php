<?php

namespace App\Http\Requests\Faq;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
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
        $Faqs = new Faq();
        if ($this->filled('q')) {
            $Faqs = $Faqs->where('question','Like','%'.$this->q.'%');
        }
        $Faqs = $Faqs->paginate($this->per_page??10);
        return $this->success_response([],FaqResource::collection($Faqs->items()),'Faqs',$Faqs);
    }
}
