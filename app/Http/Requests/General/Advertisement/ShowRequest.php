<?php

namespace App\Http\Requests\General\Advertisement;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\JsonResponse;

class ShowRequest extends ApiRequest
{
    public function rules():array
    {
        return [
            'advertisement_id'=>'required|exists:advertisements,id'
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
        return $this->success_response([],[
            'Advertisement'=>new AdvertisementResource(Advertisement::find($this->advertisement_id))
        ]);
    }
}
