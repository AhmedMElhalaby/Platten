<?php

namespace App\Http\Requests\General\Advertisement;

use App\Http\Requests\ApiRequest;
use App\Http\Resources\General\AdvertisementResource;
use App\Models\Advertisement;
use Faker\Provider\Payment;
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
            'image'=>'required|mimes:png,jpg,jpeg',
            'url'=>'required|string',
            'type'=>'required|in:1,2',
            'order'=>'nullable|in:1,2,3',
        ];
    }
    public function attributes(): array
    {
        return [
            'name'=>__('models.Advertisement.name'),
        ];
    }
    public function run(): JsonResponse
    {
        $Advertisement = new Advertisement();
        $Advertisement->name = $this->name;
        $path = $this->file('image')->store('public/advertisements');
        $Advertisement->image = $path;
        $Advertisement->url = $this->url;
        $Advertisement->type = $this->type;
        if ($this->filled('order')) {
            $Advertisement->order = $this->order;
        }
        $Advertisement->save();
        $Advertisement->refresh();
        return $this->success_response([__('messages.created_successful')],[
            'Advertisement'=>new AdvertisementResource($Advertisement)
        ]);
    }
}
