<?php

namespace App\Http\Requests\General\Product\ProductType;

use App\Http\Requests\ApiRequest;
use App\Models\ProductMedia;
use Illuminate\Http\JsonResponse;

class DeleteMediaRequest extends ApiRequest
{
    public function authorize():bool
    {
        return auth('employee')->check();
    }
    public function rules():array
    {
        return [
            'media_id'=>'required|exists:products_media,id',
        ];
    }
    public function run(): JsonResponse
    {
        $ProductMedia = (new ProductMedia())->find($this->media_id);
        $ProductMedia->delete();
        return $this->success_response([__('messages.deleted_successful')]);
    }
}
