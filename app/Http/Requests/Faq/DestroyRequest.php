<?php

namespace App\Http\Requests\Faq;

use App\Http\Requests\ApiRequest;
use App\Models\Faq;
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
            'faq_id'=>'required|exists:faqs,id',
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
        $Faq = (new Faq())->find($this->faq_id);
        $Faq->delete();
        return $this->success_response([__('messages.deleted_successfully')]);
    }
}
