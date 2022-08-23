<?php

namespace App\Http\Requests\General\Advertisement;

use App\Http\Requests\ApiRequest;
use App\Models\Advertisement;
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
            'advertisement_id'=>'required|exists:advertisements,id',
        ];
    }
    public function attributes(): array
    {
        return [
            'advertisement_id'=>__('models.Advertisement.advertisement_id'),
        ];
    }
    public function run(): JsonResponse
    {
        $Advertisement = (new Advertisement())->find($this->advertisement_id);
        try {
            $Advertisement->delete();
            return $this->success_response([__('messages.deleted_successfully')]);
        }catch (\Exception $e){
            return $this->error_response([$e->getMessage()]);
        }
    }
}
