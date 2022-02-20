<?php

namespace App\Http\Requests\Faq;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq;
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
            'country_id'=>'required|exists:faqs,id',
            'question'=>'nullable|string|max:255',
            'answer'=>'nullable|string',
        ];
    }
    public function attributes(): array
    {
        return [
            'faq_id'=>__('models.Faq.faq_id'),
            'question'=>__('models.Faq.question'),
            'answer'=>__('models.Faq.answer'),
        ];
    }
    public function run(): JsonResponse
    {
        $Faq = (new Faq())->find($this->faq_id);
        if ($this->filled('question')) {
            $Faq->question = $this->question;
        }
        if ($this->filled('answer')) {
            $Faq->answer = $this->answer;
        }
        $Faq->save();
        $Faq->refresh();
        return $this->success_response([__('messages.updated_successful')],new FaqResource($Faq),'Faq');
    }
}
