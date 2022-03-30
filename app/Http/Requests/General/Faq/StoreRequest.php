<?php

namespace App\Http\Requests\General\Faq;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\FaqResource;
use App\Models\Faq;
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
            'question'=>'required|string|max:255',
            'answer'=>'required|string',
        ];
    }
    public function attributes(): array
    {
        return [
            'question'=>__('models.Faq.question'),
            'answer'=>__('models.Faq.answer'),
        ];
    }
    public function run(): JsonResponse
    {
        $Faq = new Faq();
        $Faq->question = $this->question;
        $Faq->answer = $this->answer;
        $Faq->save();
        $Faq->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'Faq'=>new FaqResource($Faq)
        ]);
    }
}
