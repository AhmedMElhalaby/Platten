<?php

namespace App\Http\Requests\Faq;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'faq_id'=>'required|exists:faqs,id'
        ];
    }
    public function attributes(): array
    {
        return [
            'faq_id'=>__('models.Faq.faq_id'),
        ];
    }
    public function run(): JsonResponse
    {
        return $this->success_response([],new FaqResource(Faq::find($this->faq_id)),'Faq');
    }
}
